document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll('.slide');
  let currentSlide = 0;

  setInterval(() => {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
  }, 4000);
});

document.addEventListener("DOMContentLoaded", () => {
    const reveals = document.querySelectorAll(
        ".hero-artifact, .concept-text, .connection-text, .artifact"
    );

    reveals.forEach(el => el.classList.add("reveal"));

    const observer = new IntersectionObserver(
        entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("active");
                }
            });
        },
        { threshold: 0.2 }
    );

    reveals.forEach(el => observer.observe(el));
});

// ===== MUSEUM EXHIBITION - CURATOR SWITCHING =====
document.addEventListener("DOMContentLoaded", () => {
  const curatorItems = document.querySelectorAll('.curator-item');
  const exhibitionContents = document.querySelectorAll('.exhibition-content');

  curatorItems.forEach(curator => {
    curator.addEventListener('click', () => {
      // Remove active state from all curators
      curatorItems.forEach(c => c.classList.remove('active'));

      // Add active state to clicked curator
      curator.classList.add('active');

      // Get target exhibition type
      const exhibitionType = curator.dataset.exhibition;
      const targetExhibitionId = `exhibition-${exhibitionType}`;

      // Hide all exhibitions
      exhibitionContents.forEach(exhibition => {
        exhibition.classList.remove('active');
      });

      // Show target exhibition
      const targetExhibition = document.getElementById(targetExhibitionId);
      if (targetExhibition) {
        targetExhibition.classList.add('active');

        // Animate artifact cards based on exhibition type
        let cardSelector = '.artifact-card';
        if (exhibitionType === 'all') {
          cardSelector = '.artifact-card-all';
        } else if (exhibitionType === 'signature') {
          cardSelector = '.artifact-card-signature';
        } else if (exhibitionType === 'limited') {
          cardSelector = '.artifact-card-limited';
        }

        const artifactCards = targetExhibition.querySelectorAll(cardSelector);
        artifactCards.forEach((card, index) => {
          card.style.setProperty('--index', index);
          card.style.animation = 'none';
          card.offsetHeight; // trigger reflow
          card.style.animation = `artifactAppear 0.6s ease forwards`;
          card.style.animationDelay = `${index * 0.1}s`;
        });
      }

      // Smooth scroll to top of gallery
      const gallery = document.querySelector('.exhibition-gallery');
      if (gallery) {
        gallery.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
});

// ===== MODAL MENU DETAIL =====
let currentMenuId = null;
let currentMenuData = null;
let menuData = typeof menuDataFromServer !== 'undefined' ? menuDataFromServer : {};
let cart = JSON.parse(localStorage.getItem('coffeeshop_cart')) || [];

// ===== OPEN MODAL =====
function openMenuModalById(menuId) {
  currentMenuId = menuId;

  // 1. Cek apakah data menu sudah ada di server-side menuData
  if (menuData[menuId]) {
    displayModal(menuData[menuId]);
    return;
  }

  // 2. Ambil dari card jika ada
  const card = document.querySelector(`[data-menu-id="${menuId}"]`);
  if (card) {
    const menuName = card.querySelector('.artifact-name, .signature-name, .limited-name')?.textContent.trim() || '';
    const menuDescription = card.querySelector('.artifact-description, .signature-description, .limited-description')?.textContent.trim() || '';
    const menuPriceText = card.querySelector('.artifact-price, .signature-price, .limited-price')?.textContent.trim() || '';
    const menuImage = card.querySelector('.artifact-image')?.src || '';

    const priceMatch = menuPriceText.match(/[\d.]+/);
    const menuPrice = priceMatch ? priceMatch[0].replace(/\./g, '') : '0';

    const menu = { id: menuId, name: menuName, description: menuDescription, price: menuPrice, image: menuImage };
    menuData[menuId] = menu;
    displayModal(menu);
    return;
  }

  // 3. Jika tidak ada, fetch dari API
  fetch(`/api/menu/${menuId}`)
    .then(res => {
      if (!res.ok) throw new Error('Menu not found');
      return res.json();
    })
    .then(data => {
      const menu = {
        id: data.id,
        name: data.name,
        description: data.description || 'A carefully crafted coffee experience.',
        price: data.price.toString(),
        image: data.image || ''
      };
      menuData[menuId] = menu;
      displayModal(menu);
    })
    .catch(err => {
      console.error('Error fetching menu:', err);
      alert('Gagal memuat detail menu');
    });
}

// ===== DISPLAY MODAL =====
function displayModal(menu) {
  currentMenuData = menu;
  document.getElementById('modalMenuName').textContent = menu.name;
  document.getElementById('modalMenuDescription').textContent = menu.description || 'A carefully crafted coffee experience.';
  document.getElementById('modalMenuPrice').textContent = new Intl.NumberFormat('id-ID').format(parseInt(menu.price));

  const imgEl = document.getElementById('modalMenuImage');
  if (menu.image && menu.image !== '') {
    imgEl.src = menu.image;
    imgEl.alt = menu.name;
    imgEl.style.display = 'block';
  } else {
    imgEl.style.display = 'none';
  }

  document.getElementById('menuModal').classList.add('active');
  document.body.style.overflow = 'hidden';
}

// ===== CLOSE MODAL =====
function closeMenuModal() {
  document.getElementById('menuModal').classList.remove('active');
  document.body.style.overflow = '';
  currentMenuId = null;
  currentMenuData = null;
}

// ===== CART =====
function addToCart() {
  if (!currentMenuData) return;
  const menu = currentMenuData;

  const cartItem = { id: menu.id, name: menu.name, price: parseInt(menu.price), image: menu.image, quantity: 1 };
  const existingItem = cart.find(item => item.id === menu.id);
  if (existingItem) existingItem.quantity += 1;
  else cart.push(cartItem);

  localStorage.setItem('coffeeshop_cart', JSON.stringify(cart));
  showNotification(`"${menu.name}" berhasil ditambahkan ke keranjang!`);
  closeMenuModal();
}

function orderToKasir() {
  if (!currentMenuData) return;
  const menu = currentMenuData;

  const orderData = { menu_id: menu.id, name: menu.name, price: parseInt(menu.price), quantity: 1 };
  sessionStorage.setItem('pending_order', JSON.stringify(orderData));

  showNotification(`Silakan lanjutkan ke kasir untuk memesan "${menu.name}"!`);
  closeMenuModal();
}

// ===== NOTIFICATION =====
function showNotification(message) {
  const notification = document.createElement('div');
  notification.className = 'notification';
  notification.textContent = message;
  notification.style.cssText = `
    position: fixed; top: 20px; right: 20px;
    background: #6F4E37; color: white; padding: 16px 24px;
    border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    z-index: 10000; animation: slideIn 0.3s ease;
  `;
  document.body.appendChild(notification);
  setTimeout(() => {
    notification.style.animation = 'slideOut 0.3s ease';
    setTimeout(() => document.body.removeChild(notification), 300);
  }, 3000);
}

// ===== ESC CLOSE =====
document.addEventListener('keydown', e => { if(e.key === 'Escape') closeMenuModal(); });

// ===== ATTACH CLICK TO ALL MENU CARDS =====
document.querySelectorAll('.artifact-card-all, .artifact-card-signature, .artifact-card-limited')
.forEach(card => {
  const menuId = card.dataset.menuId; // pastikan di blade ada data-menu-id="{{ $menu->id }}"
  card.addEventListener('click', () => openMenuModalById(menuId));
});

// ===== MENU CARDS CLICK HANDLER =====
document.querySelectorAll('.artifact-card-all').forEach(card => {
  const menuId = card.dataset.menuId;
  card.addEventListener('click', () => openMenuModalById(menuId));
});

// ===== STAGGER ANIMATION FOR MENU CARDS =====
document.addEventListener("DOMContentLoaded", () => {
  const menuCards = document.querySelectorAll('.menu-card');
  menuCards.forEach((card, index) => {
    card.style.setProperty('--index', index);
    card.style.animation = 'none';
    card.offsetHeight; // trigger reflow
    card.style.animation = `menuCardAppear 0.8s ease forwards`;
    card.style.animationDelay = `${index * 0.15}s`;
  });
});

document.addEventListener('DOMContentLoaded', () => {
    // ===== AMBIL ELEMENT =====
    const nameInput = document.getElementById('name');
    const priceInput = document.getElementById('price');
    const descInput = document.getElementById('description');
    const imageInput = document.getElementById('image');

    const cardTitle = document.getElementById('cardTitle');
    const cardDesc = document.getElementById('cardDesc');
    const cardPrice = document.getElementById('cardPrice');
    const cardImage = document.getElementById('cardPreviewImage');
    const cardPlaceholder = document.getElementById('cardImagePlaceholder');

    if(!cardTitle || !cardDesc || !cardPrice || !cardImage || !cardPlaceholder) return;

    // ===== LIVE UPDATE TEXT =====
    nameInput.addEventListener('input', () => {
        cardTitle.textContent = nameInput.value || 'Nama Menu';
    });

    descInput.addEventListener('input', () => {
        cardDesc.textContent = descInput.value || 'Deskripsi menu akan muncul di sini';
    });

    priceInput.addEventListener('input', () => {
        cardPrice.textContent = priceInput.value || '0';
    });

    // ===== IMAGE PREVIEW =====
    imageInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(evt){
                cardImage.src = evt.target.result;
                cardImage.style.display = 'block';
                cardPlaceholder.style.display = 'none';
            }
            reader.readAsDataURL(file);
        } else {
            cardImage.style.display = 'none';
            cardPlaceholder.style.display = 'flex';
        }
    });

    // ===== TAMPILKAN IMAGE LAMA JIKA EDIT =====
    if(cardImage.dataset.current && cardImage.dataset.current !== ''){
        cardImage.src = cardImage.dataset.current;
        cardImage.style.display = 'block';
        cardPlaceholder.style.display = 'none';
    }
});









