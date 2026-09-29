@extends('layouts.app')

@section('titulo', 'Contacto y Tienda | GuauDisfraces')

@section('contenido')
    <!-- CABECERA DE CONTACTO -->
    <section class="page-header">
        <div class="container">
            <span class="badge">Estamos para ayudarte</span>
            <h1>Contacto y Tienda Física</h1>
            <p>¿Tienes dudas sobre la talla o el modelo ideal para tu peludo? ¡Escríbenos o ven a visitarnos con él!</p>
        </div>
    </section>

    <!-- SECCIÓN PRINCIPAL DE CONTACTO -->
    <section class="container contact-section">
        <div class="contact-grid">
            <!-- Formulario de dudas -->
            <div class="contact-form-box">
                <h2>Envíanos un Mensaje</h2>
                <p>Rellena el siguiente formulario y nuestro equipo de asesores caninos te responderá en menos de 24 horas.</p>

                <form class="contact-form" onsubmit="event.preventDefault(); alert('¡Gracias por tu mensaje! Te responderemos muy pronto.');">
                    <div class="form-group">
                        <label for="nombre">Nombre de la persona:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ej. Carlos Martínez" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="carlos@correo.com" required>
                    </div>

                    <div class="form-group">
                        <label for="raza">Raza y peso aproximado de tu perro:</label>
                        <input type="text" id="raza" name="raza" class="form-control" placeholder="Ej. Beagle, 12 kg">
                    </div>

                    <div class="form-group">
                        <label for="mensaje">¿Qué necesitas consultar?:</label>
                        <textarea id="mensaje" name="mensaje" rows="4" class="form-control" placeholder="Pregúntanos por disponibilidad de tallas, envíos o modelos..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar Consulta</button>
                </form>
            </div>

            <!-- Información directa de la tienda -->
            <div class="contact-info-box">
                <h2>Nuestra Tienda y Taller</h2>
                <p>Nuestra tienda física es 100% <strong>Dog Friendly</strong>. Tu mascota es bienvenida para probarse cualquier disfraz antes de comprar.</p>

                <ul class="contact-details-list">
                    <li>
                        <span class="contact-icon">📍</span>
                        <div>
                            <strong>Dirección:</strong>
                            <p>Calle Mascotas Felices 12, 28001 Madrid, España</p>
                            <!-- Enlace externo requerido -->
                            <a href="https://maps.google.com" target="_blank" rel="noopener noreferrer" class="link-inline">
                                Ver ubicación en Google Maps ↗
                            </a>
                        </div>
                    </li>
                    <li>
                        <span class="contact-icon">📞</span>
                        <div>
                            <strong>Teléfono y WhatsApp:</strong>
                            <p>+34 912 345 678 / +34 600 000 000</p>
                        </div>
                    </li>
                    <li>
                        <span class="contact-icon">✉️</span>
                        <div>
                            <strong>Email de atención:</strong>
                            <p>contacto@guaudisfraces.es</p>
                        </div>
                    </li>
                    <li>
                        <span class="contact-icon">⏰</span>
                        <div>
                            <strong>Horarios de apertura:</strong>
                            <p>Lunes a Viernes: 10:00 a 14:00 y 16:30 a 20:30</p>
                            <p>Sábados: 10:30 a 14:30 (Tardes cerrado)</p>
                            <p>Domingos y Festivos: Cerrado para pasear a los perros 🐕</p>
                        </div>
                    </li>
                </ul>

                <div class="info-highlight-card">
                    <h4>🐾 ¿Tienes un refugio o protectora?</h4>
                    <p>
                        Colaboramos con protectoras y asociaciones benéficas proporcionando disfraces para sesiones fotográficas solidarias.
                        Visita la web oficial de la <a href="https://www.fundacion-affinity.org" target="_blank" rel="noopener noreferrer" class="link-inline">Fundación Affinity ↗</a> para saber más sobre tenencia responsable.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
