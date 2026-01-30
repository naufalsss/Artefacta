document.addEventListener('DOMContentLoaded', function() {
    // ===== HAMBURGER MENU =====
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');

    hamburger.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        hamburger.classList.toggle('active');
    });

    // ===== STEP NAVIGATION =====
    const stepItems = document.querySelectorAll('.step-item');
    const bookingSections = document.querySelectorAll('.booking-section');
    let isTransitioning = false;

    function showStep(stepNumber, skipAnimation = false) {
        if (isTransitioning && !skipAnimation) return;
        isTransitioning = true;

        // Update step navigation with animation
        stepItems.forEach(item => {
            if (item.dataset.step == stepNumber) {
                item.classList.add('active');
                // Add pulse animation
                item.style.animation = 'none';
                setTimeout(() => {
                    item.style.animation = 'stepPulse 0.6s ease';
                }, 10);
            } else {
                item.classList.remove('active');
            }
        });

        // Show corresponding section with slide animation
        bookingSections.forEach(section => {
            if (section.id === `step-${stepNumber}`) {
                // Add slide-in animation
                section.style.opacity = '0';
                section.style.transform = 'translateY(30px)';
                section.classList.add('active');

                // Trigger animation
                setTimeout(() => {
                    section.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, 50);

                // Smooth scroll to section
                setTimeout(() => {
                    const headerHeight = document.querySelector('header').offsetHeight;
                    const stepNavHeight = document.querySelector('.step-navigation').offsetHeight;
                    const targetPosition = section.offsetTop - headerHeight - stepNavHeight - 20;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }, 200);

                // Update summary if showing step 3
                if (stepNumber === 3) {
                    updateSummary();
                }

                // Load cart items if showing step 2
                if (stepNumber === 2) {
                    loadCartItems();
                }
            } else {
                // Add slide-out animation for other sections
                section.style.transition = 'all 0.3s ease';
                section.style.opacity = '0';
                section.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    section.classList.remove('active');
                    section.style.opacity = '';
                    section.style.transform = '';
                    section.style.transition = '';
                }, 300);
            }
        });

        // Reset transition flag
        setTimeout(() => {
            isTransitioning = false;
        }, 600);
    }

    // Step navigation click handlers
    stepItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const stepNumber = this.dataset.step;
            showStep(stepNumber);
        });
    });

    // ===== TICKET SELECTION =====
    const ticketCards = document.querySelectorAll('.ticket-card');

    ticketCards.forEach(card => {
        card.addEventListener('click', function() {
            this.classList.toggle('selected');
            calculateTotal();
        });
    });

    // ===== QUANTITY CONTROLS =====
    function updateQuantity(card, change) {
        const input = card.querySelector('.qty-input');
        let currentValue = parseInt(input.value) || 0;
        currentValue += change;

        if (currentValue < 0) currentValue = 0;
        if (currentValue > 10) currentValue = 10;

        input.value = currentValue;

        // Update card selection state
        if (currentValue > 0) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }

        calculateTotal();
        updateQuantityButtons(card, currentValue);
    }

    function updateQuantityButtons(card, value) {
        const minusBtn = card.querySelector('.qty-btn.minus');
        const plusBtn = card.querySelector('.qty-btn.plus');

        minusBtn.disabled = value <= 0;
        plusBtn.disabled = value >= 10;
    }

    // Quantity button event listeners
    document.querySelectorAll('.qty-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent card selection
            const card = this.closest('.ticket-card');
            const change = this.classList.contains('plus') ? 1 : -1;
            updateQuantity(card, change);
        });
    });

    // Quantity input event listeners
    document.querySelectorAll('.qty-input').forEach(input => {
        input.addEventListener('change', function() {
            const card = this.closest('.ticket-card');
            let value = parseInt(this.value) || 0;

            if (value < 0) value = 0;
            if (value > 10) value = 10;

            this.value = value;
            updateQuantityButtons(card, value);
            calculateTotal();

            if (value > 0) {
                card.classList.add('selected');
            } else {
                card.classList.remove('selected');
            }
        });
    });

    // ===== COFFEE SHOP FUNCTIONALITY =====
    // Category navigation
    const categoryBtns = document.querySelectorAll('.category-btn');
    const menuCategorySections = document.querySelectorAll('.menu-category-section');

    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const category = this.dataset.category;

            // Update active category button
            categoryBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Show corresponding menu section
            menuCategorySections.forEach(section => {
                if (section.dataset.category === category) {
                    section.classList.add('active');
                } else {
                    section.classList.remove('active');
                }
            });
        });
    });

    // Menu quantity controls
    const menuQtyBtns = document.querySelectorAll('.coffee-menu .qty-btn');
    const menuQtyInputs = document.querySelectorAll('.coffee-menu .qty-input');

    menuQtyBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const menuId = this.dataset.menuId;
            const input = document.querySelector(`.qty-input[data-menu-id="${menuId}"]`);
            const currentValue = parseInt(input.value);

            if (this.classList.contains('plus')) {
                if (currentValue < 10) {
                    input.value = currentValue + 1;
                }
            } else if (this.classList.contains('minus')) {
                if (currentValue > 0) {
                    input.value = currentValue - 1;
                }
            }
        });
    });

    // ===== CALCULATE TOTAL =====
    function calculateTotal() {
        let totalTickets = 0;
        let totalPrice = 0;

        ticketCards.forEach(card => {
            if (card.classList.contains('selected')) {
                const quantity = parseInt(card.querySelector('.qty-input').value) || 0;
                const priceText = card.querySelector('.ticket-price').textContent;
                const price = parseInt(priceText.replace(/[^\d]/g, '')) || 0;

                totalTickets += quantity;
                totalPrice += quantity * price;
            }
        });

        // Get coffeeshop cart
        const coffeeshopCart = JSON.parse(localStorage.getItem('coffeeshop_cart')) || [];
        let totalCoffeePrice = 0;
        coffeeshopCart.forEach(item => {
            totalCoffeePrice += item.price * item.quantity;
        });

        // Store booking data
        const bookingData = {
            tickets: [],
            coffeeshop_cart: coffeeshopCart,
            totalTickets: totalTickets,
            totalPrice: totalPrice,
            totalCoffeePrice: totalCoffeePrice,
            grandTotal: totalPrice + totalCoffeePrice,
            date: document.getElementById('visit-date').value,
            time: document.getElementById('visit-time').value,
            customer: {
                name: document.getElementById('customer-name').value,
                phone: document.getElementById('customer-phone').value,
                email: document.getElementById('customer-email').value
            },
            notes: document.getElementById('order-notes') ? document.getElementById('order-notes').value : ''
        };

        ticketCards.forEach(card => {
            if (card.classList.contains('selected')) {
                const quantity = parseInt(card.querySelector('.qty-input').value) || 0;
                if (quantity > 0) {
                    bookingData.tickets.push({
                        type: card.dataset.ticket,
                        name: card.querySelector('h3').textContent,
                        price: parseInt(card.querySelector('.ticket-price').textContent.replace(/[^\d]/g, '')),
                        quantity: quantity
                    });
                }
            }
        });

        localStorage.setItem('bookingData', JSON.stringify(bookingData));
        return bookingData;
    }

    // ===== LOAD CART ITEMS =====
    function loadCartItems() {
        const cartItemsContainer = document.getElementById('cart-items');
        const cartSummary = document.getElementById('cart-summary');
        const cartTotalPrice = document.getElementById('cart-total-price');

        const coffeeshopCart = JSON.parse(localStorage.getItem('coffeeshop_cart')) || [];

        if (coffeeshopCart.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Keranjang Kosong</h3>
                    <p>Belum ada menu yang ditambahkan. Kunjungi halaman Coffee Shop untuk menambah menu ke keranjang.</p>
                    <a href="/coffeeshop" class="btn-primary">Kunjungi Coffee Shop</a>
                </div>
            `;
            cartSummary.style.display = 'none';
            return;
        }

        let cartHTML = '';
        let totalPrice = 0;

        coffeeshopCart.forEach(item => {
            const subtotal = item.price * item.quantity;
            totalPrice += subtotal;

            cartHTML += `
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="${item.image || '/default-image.png'}" alt="${item.name}" onerror="this.src='/default-image.png'">
                    </div>
                    <div class="cart-item-info">
                        <h4 class="cart-item-name">${item.name}</h4>
                        <div class="cart-item-details">
                            <span class="cart-item-price">Rp ${item.price.toLocaleString('id-ID')}</span>
                            <span class="cart-item-quantity">x${item.quantity}</span>
                            <span class="cart-item-subtotal">Rp ${subtotal.toLocaleString('id-ID')}</span>
                        </div>
                    </div>
                </div>
            `;
        });

        cartItemsContainer.innerHTML = cartHTML;
        cartTotalPrice.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        cartSummary.style.display = 'block';
    }

    // ===== UPDATE SUMMARY =====
    function updateSummary() {
        const summaryTicketList = document.getElementById('summary-ticket-list');
        const summaryTicketSubtotal = document.getElementById('summary-ticket-subtotal');
        const summaryCoffeeList = document.getElementById('summary-coffee-list');
        const summaryCoffeeSubtotal = document.getElementById('summary-coffee-subtotal');
        const summaryGrandTotal = document.getElementById('summary-grand-total');
        const summaryDateTime = document.getElementById('summary-date-time');
        const summaryCustomer = document.getElementById('summary-customer');

        // Clear previous summary
        if (summaryTicketList) summaryTicketList.innerHTML = '';
        if (summaryCoffeeList) summaryCoffeeList.innerHTML = '';

        let ticketTotal = 0;
        let coffeeTotal = 0;

        const bookingData = calculateTotal();

        // Update date and time
        if (summaryDateTime) {
            const date = new Date(bookingData.date);
            const formattedDate = date.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            summaryDateTime.innerHTML = `
                <div><strong>Tanggal:</strong> ${formattedDate}</div>
                <div><strong>Jam:</strong> ${bookingData.time}</div>
            `;
        }

        // Update customer info
        if (summaryCustomer) {
            summaryCustomer.innerHTML = `
                <div><strong>Nama:</strong> ${bookingData.customer.name}</div>
                <div><strong>WhatsApp:</strong> ${bookingData.customer.phone}</div>
                ${bookingData.customer.email ? `<div><strong>Email:</strong> ${bookingData.customer.email}</div>` : ''}
            `;
        }

        // Calculate ticket summary
        bookingData.tickets.forEach(ticket => {
            const subtotal = ticket.price * ticket.quantity;
            ticketTotal += subtotal;

            if (summaryTicketList) {
                const li = document.createElement('li');
                li.innerHTML = `
                    <span>${ticket.name} x${ticket.quantity}</span>
                    <span>Rp ${subtotal.toLocaleString('id-ID')}</span>
                `;
                summaryTicketList.appendChild(li);
            }
        });

        // Calculate coffee summary
        bookingData.coffeeshop_cart.forEach(item => {
            const subtotal = item.price * item.quantity;
            coffeeTotal += subtotal;

            if (summaryCoffeeList) {
                const li = document.createElement('li');
                li.innerHTML = `
                    <span>${item.name} x${item.quantity}</span>
                    <span>Rp ${subtotal.toLocaleString('id-ID')}</span>
                `;
                summaryCoffeeList.appendChild(li);
            }
        });

        // Update totals
        if (summaryTicketSubtotal) summaryTicketSubtotal.textContent = `Rp ${ticketTotal.toLocaleString('id-ID')}`;
        if (summaryCoffeeSubtotal) summaryCoffeeSubtotal.textContent = `Rp ${coffeeTotal.toLocaleString('id-ID')}`;
        if (summaryGrandTotal) summaryGrandTotal.textContent = `Rp ${bookingData.grandTotal.toLocaleString('id-ID')}`;
    }

    // ===== FORM VALIDATION =====
    function validateStep1() {
        const selectedTickets = document.querySelectorAll('.ticket-card.selected');
        const visitDate = document.getElementById('visit-date').value;
        const visitTime = document.getElementById('visit-time').value;
        const customerName = document.getElementById('customer-name').value.trim();
        const customerPhone = document.getElementById('customer-phone').value.trim();

        let isValid = true;
        let errors = [];

        // Check if at least one ticket is selected
        if (selectedTickets.length === 0) {
            errors.push('Pilih minimal satu jenis tiket');
            isValid = false;
        }

        // Check if date is selected
        if (!visitDate) {
            errors.push('Pilih tanggal kunjungan');
            isValid = false;
        }

        // Check if time is selected
        if (!visitTime) {
            errors.push('Pilih jam kunjungan');
            isValid = false;
        }

        // Check customer name
        if (!customerName) {
            errors.push('Masukkan nama pemesan');
            isValid = false;
        }

        // Check customer phone
        if (!customerPhone) {
            errors.push('Masukkan nomor WhatsApp');
            isValid = false;
        }

        // Show errors if any
        if (!isValid) {
            showNotification(errors.join('<br>'), 'error');
        }

        return isValid;
    }

    function validateStep3() {
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
        const agreeTerms = document.getElementById('agree-terms').checked;

        let isValid = true;
        let errors = [];

        if (!selectedPayment) {
            errors.push('Pilih metode pembayaran');
            isValid = false;
        }

        if (!agreeTerms) {
            errors.push('Harap setujui syarat dan ketentuan');
            isValid = false;
        }

        if (!isValid) {
            showNotification(errors.join('<br>'), 'error');
        }

        return isValid;
    }

    // ===== SUBMIT BOOKING =====
    function submitBooking() {
        const bookingData = calculateTotal();

        // Add payment and terms
        bookingData.payment_method = document.querySelector('input[name="payment_method"]:checked').value;
        bookingData.agree_terms = document.getElementById('agree-terms').checked;

        // Include coffeeshop cart in submission
        bookingData.coffeeshop_cart = JSON.parse(localStorage.getItem('coffeeshop_cart')) || [];

        // Submit via AJAX
        fetch('/booking', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(bookingData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (bookingData.payment_method === 'tempat') {
                    document.getElementById('booking-code').textContent = data.booking_code;
                    document.getElementById('success-modal').style.display = 'flex';
                    showNotification('Pemesanan berhasil!', 'success');
                } else {
                    showNotification('Pemesanan dibuat. Silakan selesaikan pembayaran.', 'success');
                    // For online payments, redirect to payment page or show payment instructions
                    // Since payment gateway not implemented, just show notification
                }
            } else {
                showNotification('Terjadi kesalahan saat memproses pemesanan', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat memproses pemesanan', 'error');
        });
    }

    // ===== STEP TRANSITIONS =====
    document.getElementById('next-to-coffee').addEventListener('click', function() {
        if (validateStep1()) {
            showStep(2);
        }
    });

    document.getElementById('back-to-tickets').addEventListener('click', function() {
        showStep(1);
    });

    document.getElementById('next-to-summary').addEventListener('click', function() {
        showStep(3);
    });

    document.getElementById('back-to-coffee').addEventListener('click', function() {
        showStep(2);
    });

    // ===== NOTIFICATION SYSTEM =====
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = message;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'error' ? '#dc3545' : '#28a745'};
            color: white;
            padding: 16px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 10000;
            max-width: 400px;
            font-size: 14px;
            line-height: 1.4;
        `;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => document.body.removeChild(notification), 300);
        }, 5000);
    }

    // ===== INITIALIZE =====
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('visit-date').setAttribute('min', today);

    // Initialize quantity buttons
    ticketCards.forEach(card => {
        updateQuantityButtons(card, 0);
    });

    // Load saved data if exists
    const savedData = localStorage.getItem('bookingData');
    if (savedData) {
        const bookingData = JSON.parse(savedData);

        // Restore ticket selections
        bookingData.tickets.forEach(ticket => {
            const card = document.querySelector(`[data-ticket="${ticket.type}"]`);
            if (card) {
                card.classList.add('selected');
                card.querySelector('.qty-input').value = ticket.quantity;
                updateQuantityButtons(card, ticket.quantity);
            }
        });

        // Restore form data
        if (bookingData.date) document.getElementById('visit-date').value = bookingData.date;
        if (bookingData.time) document.getElementById('visit-time').value = bookingData.time;
        if (bookingData.customer.name) document.getElementById('customer-name').value = bookingData.customer.name;
        if (bookingData.customer.phone) document.getElementById('customer-phone').value = bookingData.customer.phone;
        if (bookingData.customer.email) document.getElementById('customer-email').value = bookingData.customer.email;
        if (bookingData.notes) document.getElementById('order-notes').value = bookingData.notes;

        // Restore menu selections
        bookingData.menu_items.forEach(item => {
            const input = document.querySelector(`.qty-input[data-menu-id="${item.id}"]`);
            if (input) {
                input.value = item.quantity;
            }
        });
    }

    // Update summary if step 3 is active
    if (document.querySelector('.step-item.active[data-step="3"]')) {
        updateSummary();
    }

    // ===== SUCCESS MODAL FUNCTIONS =====
    window.closeSuccessModal = function() {
        document.getElementById('success-modal').style.display = 'none';
        // Reset form or redirect
        localStorage.removeItem('bookingData');
        location.reload();
    };

    window.printBooking = function() {
        window.print();
    };
});
