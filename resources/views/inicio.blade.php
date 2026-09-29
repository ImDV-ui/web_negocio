@extends('layouts.app')

@section('titulo', 'Inicio | GuauDisfraces - Disfraces Cómodos y Divertidos para Perros')

@section('contenido')
    <!-- SECCIÓN HERO / PORTADA PRINCIPAL -->
    <section class="hero-section">
        <div class="container hero-grid">
            <div class="hero-text">
                <span class="badge">🐾 Nueva Colección Especial Perruna</span>
                <h1 class="hero-title">¡Haz que tu perro sea la estrella de cualquier fiesta!</h1>
                <p class="hero-description">
                    En <strong>GuauDisfraces</strong> confeccionamos los disfraces más originales, divertidos y cómodos. 
                    Diseñados exclusivamente pensando en su bienestar: telas ultra suaves, cierres de velcro ergonómicos y total libertad de movimiento.
                </p>

                <div class="hero-highlights">
                    <div class="highlight-item">
                        <span class="hl-icon">🐕</span>
                        <span>Probado en perros reales</span>
                    </div>
                    <div class="highlight-item">
                        <span class="hl-icon">⚡</span>
                        <span>Puesta fácil en 30 seg</span>
                    </div>
                    <div class="highlight-item">
                        <span class="hl-icon">🚚</span>
                        <span>Envío gratis desde 35€</span>
                    </div>
                </div>

                <div class="hero-buttons">
                    <a href="{{ route('catalogo') }}" class="btn btn-primary">Explorar Catálogo Completo</a>
                    <button type="button" class="btn btn-secondary" onclick="window.tiendaApp.openCart();">
                        🛒 Ver Mi Carrito
                    </button>
                </div>
            </div>

            <!-- Showcase interactivo del modelo oficial Bobi -->
            <div class="hero-showcase">
                <div class="hero-image-wrapper">
                    <img id="heroShowcaseImg" src="{{ asset('images/disfraz-mago.jpg') }}" alt="Perro modelo Bobi luciendo disfraz de Mago de las Estrellas" class="hero-img">
                    <div class="hero-floating-badge">
                        <span class="badge-title">⭐ Disfraz Destacado:</span>
                        <strong id="heroCostumeName">Mago de las Estrellas</strong>
                        <span id="heroCostumePrice" class="badge-price">24,95 €</span>
                    </div>
                </div>

                <!-- Selector rápido de vistas del disfraz en portada -->
                <div class="hero-costume-thumbs" aria-label="Cambiar vista del modelo">
                    <button type="button" class="thumb-btn active" 
                            data-img="{{ asset('images/disfraz-mago.jpg') }}" 
                            data-name="Mago de las Estrellas" 
                            data-price="24,95 €"
                            data-id="1"
                            title="Ver disfraz de Mago">
                        <img src="{{ asset('images/disfraz-mago.jpg') }}" alt="Mago">
                        <span>Mago 🧙‍♂️</span>
                    </button>
                    <button type="button" class="thumb-btn" 
                            data-img="{{ asset('images/disfraz-vaquero.jpg') }}" 
                            data-name="Sheriff del Lejano Oeste" 
                            data-price="22,50 €"
                            data-id="2"
                            title="Ver disfraz de Sheriff">
                        <img src="{{ asset('images/disfraz-vaquero.jpg') }}" alt="Sheriff">
                        <span>Sheriff 🤠</span>
                    </button>
                    <button type="button" class="thumb-btn" 
                            data-img="{{ asset('images/disfraz-chef.jpg') }}" 
                            data-name="Master Chef Perruno" 
                            data-price="19,90 €"
                            data-id="3"
                            title="Ver disfraz de Chef">
                        <img src="{{ asset('images/disfraz-chef.jpg') }}" alt="Chef">
                        <span>Chef 🍳</span>
                    </button>
                    <button type="button" class="thumb-btn" 
                            data-img="{{ asset('images/disfraz-vampiro.jpg') }}" 
                            data-name="Conde Drácula Vampirín" 
                            data-price="21,95 €"
                            data-id="4"
                            title="Ver disfraz de Vampiro">
                        <img src="{{ asset('images/disfraz-vampiro.jpg') }}" alt="Vampiro">
                        <span>Vampiro 🦇</span>
                    </button>
                    <button type="button" class="thumb-btn" 
                            data-img="{{ asset('images/disfraz-abejita.jpg') }}" 
                            data-name="Abejita Zumbadora" 
                            data-price="18,95 €"
                            data-id="5"
                            title="Ver disfraz de Abejita">
                        <img src="{{ asset('images/disfraz-abejita.jpg') }}" alt="Abejita">
                        <span>Abejita 🐝</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN DE VENTAJAS Y CARACTERÍSTICAS (Requisito de lista y párrafos) -->
    <section class="features-section">
        <div class="container">
            <div class="section-header">
                <h2>¿Por qué elegir los disfraces de GuauDisfraces?</h2>
                <p>Priorizamos la comodidad, ligereza y diversión de tu compañero peludo por encima de todo.</p>
            </div>

            <!-- Lista requerida por la rúbrica -->
            <ul class="features-list">
                <li class="feature-card">
                    <span class="feature-icon">✨</span>
                    <h3>Tejidos Transpirables y Suaves</h3>
                    <p>Utilizamos terciopelo elástico, felpa térmica y algodón hipoalergénico que cuidan el pelaje y no irritan la piel.</p>
                </li>
                <li class="feature-card">
                    <span class="feature-icon">⚡</span>
                    <h3>Puesta en Menos de 30 Segundos</h3>
                    <p>Diseñados con cierres de velcro reforzados y bandas flexibles para vestir a tu perrito sin estrés, tirones ni quejas.</p>
                </li>
                <li class="feature-card">
                    <span class="feature-icon">📏</span>
                    <h3>Tallas para Todos los Peludos</h3>
                    <p>Desde la talla XS para Chihuahuas y Pomeranias hasta la XL para Beagles, Bulldogs, Labradores y mestizos.</p>
                </li>
                <li class="feature-card">
                    <span class="feature-icon">🧼</span>
                    <h3>Fáciles de Lavar en Lavadora</h3>
                    <p>Aptos para lavado a máquina a 30°C. Mantienen su textura suave y colores vivos tras cada tarde de juegos en el parque.</p>
                </li>
            </ul>
        </div>
    </section>

    <!-- SECCIÓN DE DISFRACES DESTACADOS CON AGREGADO DIRECTO AL CARRITO -->
    <section class="products-preview-section">
        <div class="container">
            <div class="section-header">
                <span class="badge">Nuestros Favoritos</span>
                <h2>Los Disfraces Más Populares</h2>
                <p>Elige tu favorito, selecciona la talla y agrégalo a tu carrito en un solo clic.</p>
            </div>

            <div class="products-grid">
                @foreach($destacados as $producto)
                    <article class="product-card" data-id="{{ $producto['id'] }}">
                        <div class="product-image-container">
                            <img src="{{ asset($producto['imagen']) }}" alt="{{ $producto['nombre'] }}" loading="lazy">
                            <span class="product-tag">{{ $producto['tag'] }}</span>
                        </div>
                        <div class="product-info">
                            <div class="product-meta-header">
                                <span class="product-category-label">{{ $producto['categoria'] }}</span>
                                <div class="product-stars">
                                    <span class="stars">★★★★★</span>
                                    <span class="rating-val">{{ $producto['rating'] }}</span>
                                </div>
                            </div>

                            <h3 class="product-title">{{ $producto['nombre'] }}</h3>
                            <p class="product-desc">{{ $producto['descripcion_corta'] }}</p>

                            <!-- Selector de talla en la tarjeta -->
                            <div class="card-size-selector">
                                <span class="size-label">Talla:</span>
                                <div class="size-pills-row">
                                    @foreach($producto['tallas'] as $index => $talla)
                                        <button type="button" class="card-size-pill {{ $talla === 'M' || ($loop->first && !in_array('M', $producto['tallas'])) ? 'active' : '' }}" data-size="{{ $talla }}">
                                            {{ $talla }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="price-wrap">
                                    <span class="price">{{ number_format($producto['precio'], 2, ',', '.') }} €</span>
                                    @if(!empty($producto['precio_anterior']))
                                        <span class="price-old">{{ number_format($producto['precio_anterior'], 2, ',', '.') }} €</span>
                                    @endif
                                </div>
                                <div class="card-action-btns">
                                    <button type="button" class="btn btn-outline-sm btn-quick-view" onclick="window.tiendaApp.openProductModal({{ $producto['id'] }})" title="Ver descripción completa y detalles">
                                        Detalles
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm btn-add-to-cart" data-id="{{ $producto['id'] }}" title="Añadir al carrito">
                                        🛒 Añadir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Banner para invitar al catálogo completo -->
            <div class="catalog-cta-banner">
                <div class="cta-banner-content">
                    <span class="cta-emoji">🐾</span>
                    <div>
                        <h3>¿Quieres ver todos nuestros modelos con fotos exclusivas?</h3>
                        <p>Descubre el catálogo completo con guías de tallas y características de confección artesanal.</p>
                    </div>
                </div>
                <a href="{{ route('catalogo') }}" class="btn btn-primary">Ver Catálogo Completo (5 Disfraces)</a>
            </div>
        </div>
    </section>

    <!-- SECCIÓN: NUESTRO EMBAJADOR CANINO Y GARANTÍA DE BIENESTAR -->
    <section class="ambassador-section">
        <div class="container ambassador-grid">
            <div class="ambassador-img-col">
                <img src="{{ asset('images/disfraz-chef.jpg') }}" alt="Bobi como Master Chef Perruno" class="ambassador-img">
                <div class="ambassador-badge">
                    <span>👑 Embajador Oficial: <strong>Bobi</strong></span>
                </div>
            </div>
            <div class="ambassador-text-col">
                <span class="badge">Compromiso Real</span>
                <h2>Diseñado para que tu perro juegue, corra y mueva la cola con alegría</h2>
                <p>
                    Ningún disfraz debe ser una molestia para tu mascota. Por eso, en <strong>GuauDisfraces</strong> cada diseño pasa una prueba real de comodidad con nuestro embajador Bobi y su pandilla peluda.
                </p>
                <ul class="ambassador-checks">
                    <li>✔️ <strong>Espacio libre para el cuello y patas:</strong> Sin rozaduras ni tiranteces en las axilas.</li>
                    <li>✔️ <strong>Apertura higiénica:</strong> Puede hacer sus necesidades con total naturalidad mientras lo lleva puesto.</li>
                    <li>✔️ <strong>Accesorios ligeros y suaves:</strong> Sombreros, varitas y alitas acolchadas que no pesan ni asustan al perro.</li>
                </ul>
                <div class="ambassador-quote">
                    <p><em>"Un perrito feliz y cómodo siempre será el alma de la fiesta."</em></p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN INFORMATIVA / COMPROMISO Y ENLACE OFICIAL -->
    <section class="care-section">
        <div class="container care-content">
            <div class="care-badge">🐕 Compromiso GuauDisfraces con la Tenencia Responsable</div>
            <h2>Consejos para una experiencia segura y feliz</h2>
            <p>
                En nuestra tienda amamos y respetamos a los animales por encima de todo. Recuerda acostumbrar a tu mascota a su prenda poco a poco, con refuerzo positivo (premios, caricias y juegos). 
                Si en algún momento notas que tu perro se siente incómodo, inquieto o estresado, retira la prenda con suavidad.
            </p>
            <p>
                Para consultar más pautas oficiales de cuidado y bienestar animal, te recomendamos visitar la web oficial de la 
                <a href="https://www.rsce.es" target="_blank" rel="noopener noreferrer" class="link-inline">Real Sociedad Canina de España ↗</a>.
            </p>
        </div>
    </section>

    <!-- Script específico para el visor dinámico del Hero -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const showcaseImg = document.getElementById('heroShowcaseImg');
            const costumeName = document.getElementById('heroCostumeName');
            const costumePrice = document.getElementById('heroCostumePrice');
            const thumbButtons = document.querySelectorAll('.hero-costume-thumbs .thumb-btn');

            thumbButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    thumbButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const newImg = this.getAttribute('data-img');
                    const newName = this.getAttribute('data-name');
                    const newPrice = this.getAttribute('data-price');

                    if (showcaseImg) {
                        showcaseImg.style.opacity = '0.4';
                        setTimeout(() => {
                            showcaseImg.src = newImg;
                            showcaseImg.alt = 'Disfraz ' + newName;
                            showcaseImg.style.opacity = '1';
                        }, 150);
                    }
                    if (costumeName) costumeName.textContent = newName;
                    if (costumePrice) costumePrice.textContent = newPrice;
                });
            });
        });
    </script>
@endsection

