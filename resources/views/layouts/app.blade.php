<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="GuauDisfraces - Tienda online especializada en disfraces divertidos, cómodos y seguros para perros. Telas suaves, elásticas y adaptadas a todas las razas.">
    <title>@yield('titulo', 'GuauDisfraces | Tienda de Disfraces para Perros')</title>

    <!-- Fuente de Google para una tipografía moderna y amigable -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Hoja de estilos personalizada del proyecto (archivo CSS local) -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

    <!-- Barra superior de anuncio -->
    <div class="top-bar">
        <p>🐾 ¡Envíos gratis en pedidos a partir de 35€! | Disfraces cómodos y seguros para todas las razas</p>
    </div>

    <!-- Header común para todas las vistas -->
    <header class="site-header">
        <div class="container header-content">
            <a href="{{ route('inicio') }}" class="logo">
                <span class="logo-icon">🐶</span>
                <div class="logo-text">
                    <span class="brand-name">GuauDisfraces</span>
                    <span class="brand-slogan">Moda & Diversión Perruna</span>
                </div>
            </a>

            <!-- Menú de navegación principal con rutas nombradas de Laravel -->
            <nav class="main-nav">
                <ul>
                    <li>
                        <a href="{{ route('inicio') }}" class="{{ request()->routeIs('inicio') ? 'active' : '' }}">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('catalogo') }}" class="{{ request()->routeIs('catalogo') ? 'active' : '' }}">
                            Catálogo
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contacto') }}" class="{{ request()->routeIs('contacto') ? 'active' : '' }}">
                            Contacto y Tienda
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Acciones de cabecera: Catálogo y Carrito Interactivo -->
            <div class="header-action-group">
                <a href="{{ route('catalogo') }}" class="btn btn-primary btn-sm btn-nav-catalog">Ver Colección</a>

                <!-- Botón de apertura del carrito con contador reactivo -->
                <button type="button" id="openCartBtn" class="cart-nav-btn" aria-label="Abrir Carrito de compras">
                    <span class="cart-btn-icon">🛒</span>
                    <span class="cart-btn-label">Carrito</span>
                    <span id="headerCartBadge" class="cart-count-badge" style="display: none;">0</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Contenido dinámico de cada vista -->
    <main class="main-content">
        @yield('contenido')
    </main>

    <!-- Footer común para todas las vistas -->
    <footer class="site-footer">
        <div class="container footer-grid">
            <!-- Columna 1: Presentación del negocio -->
            <div class="footer-col">
                <div class="footer-brand">
                    <span class="logo-icon">🐶</span>
                    <span class="brand-name">GuauDisfraces</span>
                </div>
                <p class="footer-description">
                    Somos especialistas en diseñar momentos inolvidables junto a tu mascota. Confeccionamos disfraces cómodos, suaves y adaptados a la fisonomía de cada peludo.
                </p>
                <div class="footer-guarantee">
                    <span>✨ Diseñado para el bienestar animal</span>
                </div>
            </div>

            <!-- Columna 2: Navegación interna -->
            <div class="footer-col">
                <h4 class="footer-heading">Secciones</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li><a href="{{ route('catalogo') }}">Catálogo de Disfraces</a></li>
                    <li><a href="{{ route('contacto') }}">Contacto y Ubicación</a></li>
                </ul>
            </div>

            <!-- Columna 3: Enlaces externos requeridos por la rúbrica -->
            <div class="footer-col">
                <h4 class="footer-heading">Enlaces de Interés</h4>
                <ul class="footer-links">
                    <li>
                        <a href="https://www.rsce.es" target="_blank" rel="noopener noreferrer">
                            Real Sociedad Canina de España ↗
                        </a>
                    </li>
                    <li>
                        <a href="https://www.tiendanimal.es/articulos/como-vestir-a-un-perro-comodamente/" target="_blank" rel="noopener noreferrer">
                            Guía de bienestar y confort canino ↗
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer">
                            Nuestro Instagram (@guau_disfraces) ↗
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Columna 4: Atención y contacto -->
            <div class="footer-col">
                <h4 class="footer-heading">Atención al Cliente</h4>
                <p>📍 Calle Mascotas Felices 12, Ciudad Peluda</p>
                <p>📞 900 123 456</p>
                <p>⏰ Lunes a Viernes: 10:00 - 20:00</p>
                <p>✉️ hola@guaudisfraces.es</p>
            </div>
        </div>

        <!-- Sub-footer con créditos -->
        <div class="sub-footer">
            <div class="container sub-footer-content">
                <p>&copy; {{ date('Y') }} GuauDisfraces - Proyecto Web Negocio en Laravel.</p>
                <p>Hecho con cariño para los reyes del hogar 🐾</p>
            </div>
        </div>
    </footer>

    <!-- ======================================================== -->
    <!-- COMPONENTES INTERACTIVOS DEL CARRITO Y MODALES GLOBALES   -->
    <!-- ======================================================== -->

    <!-- Overlay de Fondo para el Carrito -->
    <div id="cartOverlay" class="cart-backdrop"></div>

    <!-- Cajón Desplegable del Carrito (Slide-over Drawer) -->
    <aside id="cartDrawer" class="cart-drawer" aria-labelledby="cartDrawerHeading">
        <div class="cart-drawer-header">
            <div class="cart-title-wrapper">
                <span class="cart-header-icon">🐾</span>
                <h3 id="cartDrawerHeading">Tu Carrito Perruno</h3>
                <span class="cart-header-badge cart-count-badge" style="display: none;">0</span>
            </div>
            <button type="button" id="closeCartBtn" class="cart-close-btn" aria-label="Cerrar carrito">&times;</button>
        </div>

        <!-- Barra de Progreso de Envío Gratis -->
        <div class="shipping-meter-container">
            <div class="shipping-meter-track">
                <div id="shippingMeterBar" class="shipping-meter-progress" style="width: 0%;"></div>
            </div>
            <p id="shippingMeterText" class="shipping-meter-info">
                ¡Envíos gratis a partir de <strong>35,00 €</strong>!
            </p>
        </div>

        <!-- Lista de Artículos en el Carrito -->
        <div id="cartItemsList" class="cart-items-container">
            <!-- Rellenado dinámicamente con JavaScript -->
        </div>

        <!-- Resumen de Totales y Acciones -->
        <div id="cartFooter" class="cart-drawer-footer">
            <div class="cart-summary-line">
                <span>Subtotal:</span>
                <span id="cartSubtotal" class="summary-val">0,00 €</span>
            </div>
            <div class="cart-summary-line">
                <span>Envío estimado:</span>
                <span id="cartShipping" class="summary-val">0,00 €</span>
            </div>
            <div class="cart-summary-line total-line">
                <span>Total:</span>
                <span id="cartTotal" class="summary-total-val">0,00 €</span>
            </div>

            <div class="cart-action-buttons">
                <button type="button" id="proceedCheckoutBtn" class="btn btn-primary btn-block btn-checkout">
                    🛍️ Tramitar Pedido Ahora
                </button>
                <button type="button" id="whatsappCheckoutBtn" class="btn btn-whatsapp btn-block">
                    💬 Pedir por WhatsApp
                </button>
                <button type="button" id="clearCartBtn" class="btn-clear-cart">
                    Vaciar Carrito
                </button>
            </div>
        </div>
    </aside>

    <!-- Modal de Detalle Rápido de Producto -->
    <div id="productModalOverlay" class="modal-backdrop"></div>
    <div id="productModal" class="product-quick-modal" role="dialog" aria-modal="true">
        <button type="button" id="closeProductModalBtn" class="modal-close-btn" aria-label="Cerrar ventana">&times;</button>
        <div id="productModalBody" class="product-modal-inner">
            <!-- Rellenado dinámicamente al pulsar 'Ver detalles' -->
        </div>
    </div>

    <!-- Modal de Checkout / Confirmación de Pedido Simulado -->
    <div id="checkoutModalOverlay" class="modal-backdrop"></div>
    <div id="checkoutModal" class="checkout-modal" role="dialog" aria-modal="true">
        <button type="button" id="closeCheckoutModalBtn" class="modal-close-btn" aria-label="Cerrar ventana">&times;</button>
        <div id="checkoutModalContent" class="checkout-modal-inner">
            <div class="checkout-header">
                <span class="checkout-icon">📦</span>
                <h2>Finalizar Pedido de Disfraces</h2>
                <p>Introduce los datos para el envío o confirma tu pedido al instante.</p>
            </div>

            <!-- Resumen de artículos -->
            <div class="checkout-summary-box">
                <h4>Resumen del Pedido:</h4>
                <div id="checkoutSummaryItems"></div>
                <div class="checkout-summary-total">
                    <strong>Total a pagar:</strong>
                    <span id="checkoutGrandTotal">0,00 €</span>
                </div>
            </div>

            <!-- Formulario de Envío -->
            <form id="checkoutOrderForm" class="checkout-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="checkoutNombre">Nombre del tutor / dueño: *</label>
                        <input type="text" id="checkoutNombre" class="form-control" placeholder="Ej. Ana Gómez" required>
                    </div>
                    <div class="form-group">
                        <label for="checkoutPetName">Nombre de tu perrito/a: *</label>
                        <input type="text" id="checkoutPetName" class="form-control" placeholder="Ej. Toby, Luna..." required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="checkoutEmail">Correo electrónico: *</label>
                        <input type="email" id="checkoutEmail" class="form-control" placeholder="tucorreo@ejemplo.com" required>
                    </div>
                    <div class="form-group">
                        <label for="checkoutPhone">Teléfono de contacto: *</label>
                        <input type="tel" id="checkoutPhone" class="form-control" placeholder="+34 600 000 000" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="checkoutAddress">Dirección completa de entrega: *</label>
                    <input type="text" id="checkoutAddress" class="form-control" placeholder="Calle, número, piso, código postal y ciudad" required>
                </div>

                <div class="form-group">
                    <label for="checkoutPayment">Método de pago preferido:</label>
                    <select id="checkoutPayment" class="form-control">
                        <option value="tarjeta">💳 Tarjeta de crédito / débito</option>
                        <option value="bizum">📱 Bizum (Instantáneo)</option>
                        <option value="contra_reembolso">💶 Contra reembolso (+1,50 €)</option>
                    </select>
                </div>

                <div class="checkout-buttons">
                    <button type="submit" class="btn btn-primary btn-block">
                        ✅ Confirmar Pedido (Simulación)
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Contenedor para Notificaciones Toast -->
    <div id="toastContainer" class="toast-container" aria-live="polite"></div>

    <!-- Catálogo de productos para JavaScript -->
    <script>
        window.PRODUCTOS_DATA = @json(\App\Http\Controllers\PaginaController::getProductos());
    </script>
    <script src="{{ asset('js/tienda.js') }}"></script>
</body>
</html>
