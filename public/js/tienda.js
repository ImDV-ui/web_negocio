/**
 * GUAU DISFRACES - TIENDA & CARRITO DE COMPRAS INTERACTIVO
 * Lógica modular para gestión de carrito, persistencia en localStorage,
 * modales de producto, notificaciones toast y simulación de compra.
 */

(function () {
    'use strict';

    const STORAGE_KEY = 'guaudisfraces_cart_v1';
    const FREE_SHIPPING_THRESHOLD = 35.00;
    const STANDARD_SHIPPING_COST = 4.95;

    // Obtener catálogo desde la variable global inyectada en Blade
    function getCatalog() {
        return window.PRODUCTOS_DATA || [];
    }

    // Cargar carrito desde localStorage
    function getCart() {
        try {
            const raw = localStorage.getItem(STORAGE_KEY);
            return raw ? JSON.parse(raw) : [];
        } catch (e) {
            console.error('Error al cargar carrito desde localStorage:', e);
            return [];
        }
    }

    // Guardar carrito en localStorage y sincronizar UI
    function saveCart(cart) {
        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(cart));
        } catch (e) {
            console.error('Error al guardar carrito en localStorage:', e);
        }
        renderCartUI();
    }

    // Formatear precio a formato moneda europeo (ej. 24,95 €)
    function formatMoney(amount) {
        return Number(amount).toFixed(2).replace('.', ',') + ' €';
    }

    // Mostrar notificación Toast
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.innerHTML = `
            <span class="toast-icon">${type === 'success' ? '🐶' : 'ℹ️'}</span>
            <span class="toast-message">${message}</span>
            <button class="toast-close" aria-label="Cerrar">&times;</button>
        `;

        const closeBtn = toast.querySelector('.toast-close');
        closeBtn.addEventListener('click', () => {
            toast.classList.add('toast-hide');
            setTimeout(() => toast.remove(), 250);
        });

        container.appendChild(toast);

        // Animación de entrada
        requestAnimationFrame(() => toast.classList.add('toast-show'));

        // Auto eliminación a los 4 segundos
        setTimeout(() => {
            if (toast.isConnected) {
                toast.classList.add('toast-hide');
                setTimeout(() => toast.remove(), 250);
            }
        }, 4000);
    }

    // Añadir producto al carrito
    function addToCart(productId, size = 'M', quantity = 1, options = {}) {
        const catalog = getCatalog();
        const product = catalog.find(p => Number(p.id) === Number(productId));

        if (!product) {
            console.error('Producto no encontrado con ID:', productId);
            return;
        }

        const qty = parseInt(quantity, 10) || 1;
        const chosenSize = size || (product.tallas && product.tallas[0]) || 'M';
        const cart = getCart();

        // Buscar si ya existe el producto con la misma talla
        const existingIndex = cart.findIndex(item => Number(item.id) === Number(productId) && item.size === chosenSize);

        if (existingIndex > -1) {
            cart[existingIndex].qty += qty;
        } else {
            cart.push({
                id: product.id,
                slug: product.slug,
                nombre: product.nombre,
                precio: parseFloat(product.precio),
                imagen: product.imagen,
                size: chosenSize,
                qty: qty
            });
        }

        saveCart(cart);

        // Feedback sonoro/visual
        showToast(`¡Añadido! <strong>${product.nombre}</strong> (Talla ${chosenSize})`);

        // Si se solicita, abrir el cajón del carrito
        if (options.openDrawer !== false) {
            openCartDrawer();
        }
    }

    // Actualizar cantidad de un artículo en el carrito
    function updateItemQty(index, change) {
        const cart = getCart();
        if (!cart[index]) return;

        cart[index].qty += change;

        if (cart[index].qty <= 0) {
            cart.splice(index, 1);
            showToast('Disfraz retirado del carrito.', 'info');
        }

        saveCart(cart);
    }

    // Eliminar completamente un artículo
    function removeItem(index) {
        const cart = getCart();
        if (!cart[index]) return;

        const removedName = cart[index].nombre;
        cart.splice(index, 1);
        saveCart(cart);
        showToast(`Se ha eliminado ${removedName} del carrito.`, 'info');
    }

    // Vaciar carrito por completo
    function clearCart() {
        const cart = getCart();
        if (cart.length === 0) return;

        if (confirm('¿Estás seguro de que deseas vaciar tu carrito?')) {
            saveCart([]);
            showToast('Carrito vaciado.', 'info');
        }
    }

    // Renderizar estado del carrito en la interfaz
    function renderCartUI() {
        const cart = getCart();
        const countBadges = document.querySelectorAll('.cart-count-badge');
        const cartItemsList = document.getElementById('cartItemsList');
        const cartSubtotalEl = document.getElementById('cartSubtotal');
        const cartShippingEl = document.getElementById('cartShipping');
        const cartTotalEl = document.getElementById('cartTotal');
        const cartFooter = document.getElementById('cartFooter');
        const shippingMeterBar = document.getElementById('shippingMeterBar');
        const shippingMeterText = document.getElementById('shippingMeterText');

        // Total de unidades
        const totalItemsCount = cart.reduce((sum, item) => sum + item.qty, 0);

        countBadges.forEach(badge => {
            badge.textContent = totalItemsCount;
            badge.style.display = totalItemsCount > 0 ? 'inline-flex' : 'none';
            // Micro animación de rebote
            badge.classList.remove('badge-bounce');
            void badge.offsetWidth;
            badge.classList.add('badge-bounce');
        });

        // Calcular subtotal
        const subtotal = cart.reduce((sum, item) => sum + (item.precio * item.qty), 0);
        const hasFreeShipping = subtotal >= FREE_SHIPPING_THRESHOLD;
        const shippingCost = (subtotal > 0 && !hasFreeShipping) ? STANDARD_SHIPPING_COST : 0;
        const grandTotal = subtotal > 0 ? (subtotal + shippingCost) : 0;

        // Barra de envío gratis
        if (shippingMeterBar && shippingMeterText) {
            if (subtotal === 0) {
                shippingMeterBar.style.width = '0%';
                shippingMeterText.innerHTML = `¡Envíos gratis en pedidos a partir de <strong>${formatMoney(FREE_SHIPPING_THRESHOLD)}</strong>!`;
            } else if (hasFreeShipping) {
                shippingMeterBar.style.width = '100%';
                shippingMeterBar.classList.add('free-shipping-achieved');
                shippingMeterText.innerHTML = `🎉 ¡Genial! Tu pedido tiene <strong>ENVÍO GRATIS</strong>`;
            } else {
                const remaining = FREE_SHIPPING_THRESHOLD - subtotal;
                const percentage = Math.min(100, Math.round((subtotal / FREE_SHIPPING_THRESHOLD) * 100));
                shippingMeterBar.style.width = `${percentage}%`;
                shippingMeterBar.classList.remove('free-shipping-achieved');
                shippingMeterText.innerHTML = `Te faltan solo <strong>${formatMoney(remaining)}</strong> para envío gratis 🚚`;
            }
        }

        // Renderizar lista de artículos
        if (cartItemsList) {
            if (cart.length === 0) {
                cartItemsList.innerHTML = `
                    <div class="cart-empty-state">
                        <span class="empty-icon">🐕</span>
                        <h4>Tu carrito está vacío</h4>
                        <p>Tu peludo está esperando su nuevo look. ¡Explora nuestros disfraces con encanto!</p>
                        <a href="/catalogo" class="btn btn-primary btn-sm btn-empty-cart" onclick="window.tiendaApp.closeCart();">
                            Ver Colección de Disfraces
                        </a>
                    </div>
                `;
                if (cartFooter) cartFooter.style.display = 'none';
            } else {
                if (cartFooter) cartFooter.style.display = 'block';

                cartItemsList.innerHTML = cart.map((item, index) => {
                    const itemTotal = item.precio * item.qty;
                    return `
                        <div class="cart-item" data-index="${index}">
                            <div class="cart-item-image">
                                <img src="/${item.imagen}" alt="${item.nombre}">
                            </div>
                            <div class="cart-item-details">
                                <h4 class="cart-item-title">${item.nombre}</h4>
                                <div class="cart-item-meta">
                                    <span class="cart-item-size">Talla: <strong>${item.size}</strong></span>
                                    <span class="cart-item-unit-price">${formatMoney(item.precio)} / ud.</span>
                                </div>
                                <div class="cart-item-actions">
                                    <div class="quantity-controller">
                                        <button type="button" class="btn-qty" onclick="window.tiendaApp.updateQty(${index}, -1)" title="Reducir cantidad" aria-label="Reducir cantidad">-</button>
                                        <span class="qty-display">${item.qty}</span>
                                        <button type="button" class="btn-qty" onclick="window.tiendaApp.updateQty(${index}, 1)" title="Aumentar cantidad" aria-label="Aumentar cantidad">+</button>
                                    </div>
                                    <span class="cart-item-subtotal">${formatMoney(itemTotal)}</span>
                                    <button type="button" class="btn-remove-item" onclick="window.tiendaApp.removeItem(${index})" title="Eliminar del carrito" aria-label="Eliminar producto">
                                        🗑️
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('');
            }
        }

        // Totales numéricos
        if (cartSubtotalEl) cartSubtotalEl.textContent = formatMoney(subtotal);
        if (cartShippingEl) {
            cartShippingEl.textContent = subtotal === 0 ? '0,00 €' : (hasFreeShipping ? '¡GRATIS!' : formatMoney(shippingCost));
            if (hasFreeShipping && subtotal > 0) {
                cartShippingEl.classList.add('free-shipping-tag');
            } else {
                cartShippingEl.classList.remove('free-shipping-tag');
            }
        }
        if (cartTotalEl) cartTotalEl.textContent = formatMoney(grandTotal);
    }

    // Abrir cajón del carrito
    function openCartDrawer() {
        const drawer = document.getElementById('cartDrawer');
        const overlay = document.getElementById('cartOverlay');
        if (drawer && overlay) {
            drawer.classList.add('active');
            overlay.classList.add('active');
            document.body.classList.add('modal-open');
        }
    }

    // Cerrar cajón del carrito
    function closeCartDrawer() {
        const drawer = document.getElementById('cartDrawer');
        const overlay = document.getElementById('cartOverlay');
        if (drawer && overlay) {
            drawer.classList.remove('active');
            overlay.classList.remove('active');
            document.body.classList.remove('modal-open');
        }
    }

    // Modal de Detalle Rápido de Producto
    function openProductModal(productId) {
        const catalog = getCatalog();
        const product = catalog.find(p => Number(p.id) === Number(productId));
        if (!product) return;

        const modalBody = document.getElementById('productModalBody');
        const modal = document.getElementById('productModal');
        const overlay = document.getElementById('productModalOverlay');

        if (!modalBody || !modal || !overlay) return;

        const tallasHtml = (product.tallas || ['M']).map((talla, idx) => `
            <button type="button" class="modal-size-pill ${idx === 1 || (product.tallas.length === 1 && idx === 0) ? 'selected' : ''}" data-size="${talla}">
                ${talla}
            </button>
        `).join('');

        modalBody.innerHTML = `
            <div class="product-modal-grid">
                <div class="product-modal-image-col">
                    <div class="product-modal-img-wrap">
                        <img src="/${product.imagen}" alt="${product.nombre}" id="modalProductImg">
                        <span class="product-modal-tag">${product.tag || 'Exclusivo'}</span>
                    </div>
                </div>
                <div class="product-modal-info-col">
                    <span class="product-modal-category">${product.categoria}</span>
                    <h2 class="product-modal-title">${product.nombre}</h2>

                    <div class="product-modal-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-num">${product.rating || '5.0'}</span>
                        <span class="reviews-count">(${product.reviews_count || '45'} valoraciones de familias perrunas)</span>
                    </div>

                    <div class="product-modal-pricing">
                        <span class="current-price">${formatMoney(product.precio)}</span>
                        ${product.precio_anterior ? `<span class="old-price">${formatMoney(product.precio_anterior)}</span>` : ''}
                        <span class="iva-note">IVA incluido | Envío rápido 24-48h</span>
                    </div>

                    <p class="product-modal-desc">${product.descripcion_larga || product.descripcion_corta}</p>

                    <!-- Especificaciones técnicas -->
                    <div class="product-modal-specs">
                        <div class="spec-row">
                            <span class="spec-label">🧵 Material:</span>
                            <span class="spec-value">${product.material}</span>
                        </div>
                        <div class="spec-row">
                            <span class="spec-label">🔒 Cierre:</span>
                            <span class="spec-value">${product.cierre}</span>
                        </div>
                        <div class="spec-row">
                            <span class="spec-label">🧼 Lavado:</span>
                            <span class="spec-value">${product.lavado}</span>
                        </div>
                        <div class="spec-row">
                            <span class="spec-label">📦 Incluye:</span>
                            <span class="spec-value">${product.incluye}</span>
                        </div>
                    </div>

                    <!-- Selector de talla -->
                    <div class="product-modal-sizes-section">
                        <div class="size-header">
                            <label><strong>Selecciona la Talla:</strong></label>
                            <span class="size-guide-hint">🐶 ¿Dudas? Elige una talla más holgada</span>
                        </div>
                        <div class="modal-sizes-group" id="modalSizesGroup">
                            ${tallasHtml}
                        </div>
                    </div>

                    <!-- Cantidad y Botón de añadir -->
                    <div class="product-modal-actions">
                        <div class="quantity-controller modal-quantity">
                            <button type="button" class="btn-qty" id="modalQtyMinus">-</button>
                            <span class="qty-display" id="modalQtyDisplay">1</span>
                            <button type="button" class="btn-qty" id="modalQtyPlus">+</button>
                        </div>
                        <button type="button" class="btn btn-primary btn-add-modal" id="modalAddToCartBtn">
                            🛒 Añadir al Carrito
                        </button>
                    </div>
                </div>
            </div>
        `;

        // Lógica de selección de talla dentro del modal
        let selectedSize = 'M';
        const defaultSelected = modalBody.querySelector('.modal-size-pill.selected');
        if (defaultSelected) {
            selectedSize = defaultSelected.getAttribute('data-size');
        }

        const sizePills = modalBody.querySelectorAll('.modal-size-pill');
        sizePills.forEach(pill => {
            pill.addEventListener('click', () => {
                sizePills.forEach(p => p.classList.remove('selected'));
                pill.classList.add('selected');
                selectedSize = pill.getAttribute('data-size');
            });
        });

        // Lógica de cantidad dentro del modal
        let currentQty = 1;
        const qtyDisplay = modalBody.querySelector('#modalQtyDisplay');
        const qtyMinus = modalBody.querySelector('#modalQtyMinus');
        const qtyPlus = modalBody.querySelector('#modalQtyPlus');

        qtyMinus.addEventListener('click', () => {
            if (currentQty > 1) {
                currentQty--;
                qtyDisplay.textContent = currentQty;
            }
        });

        qtyPlus.addEventListener('click', () => {
            currentQty++;
            qtyDisplay.textContent = currentQty;
        });

        // Evento de añadir al carrito
        const addBtn = modalBody.querySelector('#modalAddToCartBtn');
        addBtn.addEventListener('click', () => {
            addToCart(product.id, selectedSize, currentQty, { openDrawer: true });
            closeProductModal();
        });

        // Mostrar modal
        modal.classList.add('active');
        overlay.classList.add('active');
        document.body.classList.add('modal-open');
    }

    function closeProductModal() {
        const modal = document.getElementById('productModal');
        const overlay = document.getElementById('productModalOverlay');
        if (modal && overlay) {
            modal.classList.remove('active');
            overlay.classList.remove('active');
            document.body.classList.remove('modal-open');
        }
    }

    // Modal de Checkout / Tramitar Pedido
    function openCheckoutModal() {
        const cart = getCart();
        if (cart.length === 0) {
            showToast('Tu carrito está vacío. Agrega disfraces primero.', 'info');
            return;
        }

        closeCartDrawer();

        const modal = document.getElementById('checkoutModal');
        const overlay = document.getElementById('checkoutModalOverlay');
        const summaryContainer = document.getElementById('checkoutSummaryItems');
        const checkoutTotalEl = document.getElementById('checkoutGrandTotal');

        if (!modal || !overlay) return;

        const subtotal = cart.reduce((sum, item) => sum + (item.precio * item.qty), 0);
        const hasFreeShipping = subtotal >= FREE_SHIPPING_THRESHOLD;
        const shippingCost = hasFreeShipping ? 0 : STANDARD_SHIPPING_COST;
        const total = subtotal + shippingCost;

        if (summaryContainer) {
            summaryContainer.innerHTML = cart.map(item => `
                <div class="checkout-summary-row">
                    <span class="chk-item-title">${item.nombre} (Talla ${item.size}) &times; ${item.qty}</span>
                    <span class="chk-item-price">${formatMoney(item.precio * item.qty)}</span>
                </div>
            `).join('') + `
                <div class="checkout-summary-divider"></div>
                <div class="checkout-summary-row">
                    <span>Subtotal:</span>
                    <span>${formatMoney(subtotal)}</span>
                </div>
                <div class="checkout-summary-row">
                    <span>Envío:</span>
                    <span>${hasFreeShipping ? '¡GRATIS!' : formatMoney(shippingCost)}</span>
                </div>
            `;
        }

        if (checkoutTotalEl) {
            checkoutTotalEl.textContent = formatMoney(total);
        }

        modal.classList.add('active');
        overlay.classList.add('active');
        document.body.classList.add('modal-open');
    }

    function closeCheckoutModal() {
        const modal = document.getElementById('checkoutModal');
        const overlay = document.getElementById('checkoutModalOverlay');
        if (modal && overlay) {
            modal.classList.remove('active');
            overlay.classList.remove('active');
            document.body.classList.remove('modal-open');
        }
    }

    // Finalizar pedido simulado
    function submitCheckoutForm(event) {
        event.preventDefault();
        const form = event.target;
        const nombre = form.querySelector('#checkoutNombre')?.value || 'Cliente Peludo';
        const modalContent = document.getElementById('checkoutModalContent');

        if (modalContent) {
            modalContent.innerHTML = `
                <div class="checkout-success-view">
                    <span class="success-icon">🎉</span>
                    <h2>¡Pedido Confirmado con Éxito!</h2>
                    <p class="success-greeting">¡Muchas gracias, <strong>${nombre}</strong>!</p>
                    <p>Hemos recibido la orden de tu pedido de disfraces perrunos. Te llegará un correo de confirmación y el seguimiento en las próximas 24 horas.</p>
                    <div class="order-badge">
                        <span>Código de Referencia: <strong>GD-${Math.floor(100000 + Math.random() * 900000)}</strong></span>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="window.tiendaApp.finishOrder();">
                        Volver a la Tienda 🐶
                    </button>
                </div>
            `;
        }

        // Vaciar carrito
        saveCart([]);
    }

    // Generar enlace para comprar por WhatsApp
    function checkoutViaWhatsApp() {
        const cart = getCart();
        if (cart.length === 0) return;

        const subtotal = cart.reduce((sum, item) => sum + (item.precio * item.qty), 0);
        const hasFreeShipping = subtotal >= FREE_SHIPPING_THRESHOLD;
        const shippingCost = hasFreeShipping ? 0 : STANDARD_SHIPPING_COST;
        const total = subtotal + shippingCost;

        let message = `¡Hola GuauDisfraces! 🐾 Quiero realizar el siguiente pedido:\n\n`;
        cart.forEach((item, idx) => {
            message += `${idx + 1}. *${item.nombre}*\n   - Talla: ${item.size}\n   - Unidades: ${item.qty}\n   - Subtotal: ${formatMoney(item.precio * item.qty)}\n\n`;
        });

        message += `*Subtotal:* ${formatMoney(subtotal)}\n`;
        message += `*Envío:* ${hasFreeShipping ? 'GRATIS' : formatMoney(shippingCost)}\n`;
        message += `*TOTAL A PAGAR:* ${formatMoney(total)}\n\n`;
        message += `¿Me indicáis los pasos para el pago y la entrega? ¡Muchas gracias!`;

        const encoded = encodeURIComponent(message);
        const whatsappUrl = `https://wa.me/34900123456?text=${encoded}`;
        window.open(whatsappUrl, '_blank');
    }

    // Inicialización de eventos al cargar el DOM
    document.addEventListener('DOMContentLoaded', () => {
        // Render inicial del carrito
        renderCartUI();

        // Botón abrir carrito en navbar
        const openCartBtn = document.getElementById('openCartBtn');
        if (openCartBtn) {
            openCartBtn.addEventListener('click', openCartDrawer);
        }

        // Botón cerrar carrito
        const closeCartBtn = document.getElementById('closeCartBtn');
        if (closeCartBtn) {
            closeCartBtn.addEventListener('click', closeCartDrawer);
        }

        // Overlay carrito
        const cartOverlay = document.getElementById('cartOverlay');
        if (cartOverlay) {
            cartOverlay.addEventListener('click', closeCartDrawer);
        }

        // Botón vaciar carrito
        const clearCartBtn = document.getElementById('clearCartBtn');
        if (clearCartBtn) {
            clearCartBtn.addEventListener('click', clearCart);
        }

        // Botón tramitar compra
        const proceedCheckoutBtn = document.getElementById('proceedCheckoutBtn');
        if (proceedCheckoutBtn) {
            proceedCheckoutBtn.addEventListener('click', openCheckoutModal);
        }

        // Botón comprar por WhatsApp desde el carrito
        const whatsappCheckoutBtn = document.getElementById('whatsappCheckoutBtn');
        if (whatsappCheckoutBtn) {
            whatsappCheckoutBtn.addEventListener('click', checkoutViaWhatsApp);
        }

        // Modales overlay y cerrar
        const productModalOverlay = document.getElementById('productModalOverlay');
        const closeProductModalBtn = document.getElementById('closeProductModalBtn');
        if (productModalOverlay) productModalOverlay.addEventListener('click', closeProductModal);
        if (closeProductModalBtn) closeProductModalBtn.addEventListener('click', closeProductModal);

        const checkoutModalOverlay = document.getElementById('checkoutModalOverlay');
        const closeCheckoutModalBtn = document.getElementById('closeCheckoutModalBtn');
        if (checkoutModalOverlay) checkoutModalOverlay.addEventListener('click', closeCheckoutModal);
        if (closeCheckoutModalBtn) closeCheckoutModalBtn.addEventListener('click', closeCheckoutModal);

        const checkoutForm = document.getElementById('checkoutOrderForm');
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', submitCheckoutForm);
        }

        // Cerrar con Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeCartDrawer();
                closeProductModal();
                closeCheckoutModal();
            }
        });

        // Configuración de tarjetas de producto con selectores de talla rápidos
        document.querySelectorAll('.product-card').forEach(card => {
            const sizePills = card.querySelectorAll('.card-size-pill');
            let currentSelectedSize = 'M';

            sizePills.forEach(pill => {
                pill.addEventListener('click', (e) => {
                    e.stopPropagation();
                    sizePills.forEach(p => p.classList.remove('active'));
                    pill.classList.add('active');
                    currentSelectedSize = pill.getAttribute('data-size');
                });
            });

            // Botón de Añadir rápido
            const addBtn = card.querySelector('.btn-add-to-cart');
            if (addBtn) {
                addBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const productId = addBtn.getAttribute('data-id');
                    addToCart(productId, currentSelectedSize, 1, { openDrawer: true });
                });
            }
        });
    });

    // API pública expuesta en window para eventos inline y componentes
    window.tiendaApp = {
        addToCart: addToCart,
        updateQty: updateItemQty,
        removeItem: removeItem,
        clearCart: clearCart,
        openCart: openCartDrawer,
        closeCart: closeCartDrawer,
        openProductModal: openProductModal,
        closeProductModal: closeProductModal,
        openCheckout: openCheckoutModal,
        closeCheckout: closeCheckoutModal,
        finishOrder: () => {
            closeCheckoutModal();
            window.location.href = '/catalogo';
        }
    };

})();
