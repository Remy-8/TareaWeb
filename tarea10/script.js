// JavaScript simplificado para el prototipo

// Variables globales
let usuarioActual = null;

// Inicialización
document.addEventListener('DOMContentLoaded', function() {
    inicializarPagina();
});

function inicializarPagina() {
    // Auto-completar fecha actual
    const fechaInput = document.getElementById('fecha');
    if (fechaInput) {
        const ahora = new Date();
        const fechaFormato = ahora.toISOString().slice(0, 16);
        fechaInput.value = fechaFormato;
    }
    
    console.log('Página inicializada');
}

// === FUNCIONES DEL MAPA ===

function aplicarFiltros() {
    const provincia = document.getElementById('provincia-filter').value;
    const tipo = document.getElementById('tipo-filter').value;
    const busqueda = document.getElementById('buscar').value;
    
    console.log('Filtros aplicados:', { provincia, tipo, busqueda });
    mostrarMensaje('Filtros aplicados correctamente', 'info');
}

function mostrarDetalle(id) {
    const incidencias = {
        1: {
            titulo: 'Accidente de tránsito en Malecón',
            fecha: '17/08/2025 - 14:30',
            ubicacion: 'Malecón de Santo Domingo',
            descripcion: 'Colisión frontal entre dos vehículos.',
            impacto: '0 muertos, 3 heridos'
        },
        2: {
            titulo: 'Robo a mano armada',
            fecha: '17/08/2025 - 10:15',
            ubicacion: 'Supermercado La Sirena',
            descripcion: 'Asalto a mano armada en supermercado.',
            impacto: '0 muertos, 1 herido'
        },
        3: {
            titulo: 'Pelea en bar',
            fecha: '17/08/2025 - 02:30',
            ubicacion: 'Zona Colonial',
            descripcion: 'Altercado entre varios grupos.',
            impacto: '0 muertos, 2 heridos'
        }
    };
    
    const incidencia = incidencias[id];
    if (incidencia) {
        const contenido = `
            <h3>${incidencia.titulo}</h3>
            <p><strong>Fecha:</strong> ${incidencia.fecha}</p>
            <p><strong>Ubicación:</strong> ${incidencia.ubicacion}</p>
            <p><strong>Descripción:</strong> ${incidencia.descripcion}</p>
            <p><strong>Impacto:</strong> ${incidencia.impacto}</p>
        `;
        
        document.getElementById('modal-body').innerHTML = contenido;
        mostrarModal();
    }
}

// === FUNCIONES DE LOGIN ===

function loginOAuth(proveedor) {
    mostrarMensaje('Conectando con ' + proveedor + '...', 'info');
    
    setTimeout(() => {
        usuarioActual = {
            email: 'usuario@' + proveedor + '.com',
            tipo: 'reportero',
            proveedor: proveedor
        };
        
        mostrarMensaje('Login exitoso con ' + proveedor, 'success');
        
        setTimeout(() => {
            window.location.href = 'index.html';
        }, 2000);
    }, 2000);
}

function loginValidador(event) {
    event.preventDefault();
    
    const usuario = document.getElementById('usuario').value;
    const password = document.getElementById('password').value;
    
    // Validación simple
    if (!usuario || !password) {
        mostrarMensaje('Complete todos los campos', 'error');
        return false;
    }
    
    // Credenciales de prueba
    if (usuario === 'admin' && password === 'admin123') {
        usuarioActual = {
            usuario: usuario,
            tipo: 'validador'
        };
        
        mostrarMensaje('Login exitoso como validador', 'success');
        
        setTimeout(() => {
            window.location.href = 'validation.html';
        }, 2000);
    } else {
        mostrarMensaje('Credenciales incorrectas. Use: admin/admin123', 'error');
    }
    
    return false;
}

// === FUNCIONES DE REPORTE ===

function actualizarMunicipios() {
    const provincia = document.getElementById('provincia').value;
    const municipioSelect = document.getElementById('municipio');
    
    // Limpiar opciones
    municipioSelect.innerHTML = '<option value="">Seleccione municipio</option>';
    
    // Datos simulados
    const municipios = {
        'santo_domingo': ['Distrito Nacional', 'Santo Domingo Este', 'Santo Domingo Norte'],
        'santiago': ['Santiago', 'Licey al Medio', 'Tamboril'],
        'la_vega': ['La Vega', 'Constanza', 'Jarabacoa']
    };
    
    if (municipios[provincia]) {
        municipios[provincia].forEach(municipio => {
            const option = document.createElement('option');
            option.value = municipio.toLowerCase().replace(/\s+/g, '_');
            option.textContent = municipio;
            municipioSelect.appendChild(option);
        });
    }
}

function detectarUbicacion() {
    mostrarMensaje('Detectando ubicación...', 'info');
    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude.toFixed(6);
                const lng = position.coords.longitude.toFixed(6);
                document.getElementById('coordenadas').value = `${lat}, ${lng}`;
                mostrarMensaje('Ubicación detectada', 'success');
            },
            function() {
                // Coordenadas por defecto de Santo Domingo
                document.getElementById('coordenadas').value = '18.4861, -69.9312';
                mostrarMensaje('Se usó ubicación por defecto', 'info');
            }
        );
    } else {
        document.getElementById('coordenadas').value = '18.4861, -69.9312';
        mostrarMensaje('Geolocalización no disponible', 'error');
    }
}

function guardarBorrador() {
    const datos = recopilarDatosFormulario();
    
    // Simular guardado en localStorage
    try {
        localStorage.setItem('borrador_reporte', JSON.stringify(datos));
        mostrarMensaje('Borrador guardado correctamente', 'success');
    } catch (error) {
        // Fallback si localStorage no está disponible
        window.borradorGuardado = datos;
        mostrarMensaje('Borrador guardado en memoria', 'info');
    }
}

function enviarReporte(event) {
    event.preventDefault();
    
    // Validar formulario
    if (!validarFormularioReporte()) {
        return false;
    }
    
    const datos = recopilarDatosFormulario();
    
    mostrarMensaje('Enviando reporte...', 'info');
    
    // Simular envío
    setTimeout(() => {
        mostrarMensaje('Reporte enviado exitosamente. Será revisado por un validador.', 'success');
        
        // Limpiar formulario
        document.querySelector('.report-form').reset();
        
        // Redirigir después de un momento
        setTimeout(() => {
            window.location.href = 'index.html';
        }, 3000);
    }, 2000);
    
    return false;
}

function validarFormularioReporte() {
    const titulo = document.getElementById('titulo').value.trim();
    const descripcion = document.getElementById('descripcion').value.trim();
    const provincia = document.getElementById('provincia').value;
    const municipio = document.getElementById('municipio').value;
    
    // Verificar tipos seleccionados
    const tiposSeleccionados = document.querySelectorAll('input[name="tipo"]:checked');
    
    if (!titulo) {
        mostrarMensaje('El título es obligatorio', 'error');
        return false;
    }
    
    if (!descripcion) {
        mostrarMensaje('La descripción es obligatoria', 'error');
        return false;
    }
    
    if (!provincia) {
        mostrarMensaje('Debe seleccionar una provincia', 'error');
        return false;
    }
    
    if (!municipio) {
        mostrarMensaje('Debe seleccionar un municipio', 'error');
        return false;
    }
    
    if (tiposSeleccionados.length === 0) {
        mostrarMensaje('Debe seleccionar al menos un tipo de incidencia', 'error');
        return false;
    }
    
    return true;
}

function recopilarDatosFormulario() {
    const tipos = [];
    document.querySelectorAll('input[name="tipo"]:checked').forEach(checkbox => {
        tipos.push(checkbox.value);
    });
    
    return {
        fecha: document.getElementById('fecha').value,
        titulo: document.getElementById('titulo').value,
        tipos: tipos,
        descripcion: document.getElementById('descripcion').value,
        provincia: document.getElementById('provincia').value,
        municipio: document.getElementById('municipio').value,
        barrio: document.getElementById('barrio').value,
        coordenadas: document.getElementById('coordenadas').value,
        muertos: document.getElementById('muertos').value,
        heridos: document.getElementById('heridos').value,
        perdida: document.getElementById('perdida').value,
        redes: document.getElementById('redes').value
    };
}

// === FUNCIONES DE VALIDACIÓN ===

function actualizarReportes() {
    mostrarMensaje('Actualizando lista de reportes...', 'info');
    
    setTimeout(() => {
        mostrarMensaje('Lista actualizada', 'success');
    }, 1000);
}

function aprobarReporte(id) {
    if (confirm('¿Está seguro de que desea aprobar este reporte?')) {
        mostrarMensaje(`Reporte #${id} aprobado exitosamente`, 'success');
        
        // Simular remoción del reporte
        const card = document.querySelector(`[data-id="${id}"]`);
        if (card) {
            card.style.opacity = '0.5';
            card.querySelector('.estado-badge').textContent = 'APROBADO';
            card.querySelector('.estado-badge').className = 'estado-badge aprobado';
        }
    }
}

function rechazarReporte(id) {
    const razon = prompt('Ingrese la razón del rechazo:');
    if (razon) {
        mostrarMensaje(`Reporte #${id} rechazado: ${razon}`, 'info');
        
        const card = document.querySelector(`[data-id="${id}"]`);
        if (card) {
            card.style.opacity = '0.5';
            card.querySelector('.estado-badge').textContent = 'RECHAZADO';
            card.querySelector('.estado-badge').className = 'estado-badge rechazado';
        }
    }
}

function editarReporte(id) {
    const nuevaDescripcion = prompt('Ingrese la nueva descripción:');
    if (nuevaDescripcion) {
        mostrarMensaje(`Reporte #${id} editado exitosamente`, 'success');
        
        const card = document.querySelector(`[data-id="${id}"]`);
        if (card) {
            const descripcionP = card.querySelector('.reporte-info p:last-child');
            if (descripcionP) {
                descripcionP.innerHTML = `<strong>📝 Descripción:</strong> ${nuevaDescripcion}`;
            }
        }
    }
}

function unirReportes(id1, id2) {
    if (confirm(`¿Desea unir los reportes #${id1} y #${id2}?`)) {
        mostrarMensaje(`Reportes #${id1} y #${id2} unidos exitosamente`, 'success');
        
        // Remover el segundo reporte
        const card2 = document.querySelector(`[data-id="${id2}"]`);
        if (card2) {
            card2.style.display = 'none';
        }
        
        // Marcar el primero como unificado
        const card1 = document.querySelector(`[data-id="${id1}"]`);
        if (card1) {
            const header = card1.querySelector('.reporte-header');
            const badge = document.createElement('span');
            badge.className = 'similar-badge';
            badge.textContent = '🔗 UNIFICADO';
            header.appendChild(badge);
        }
    }
}

function marcarUnico(id) {
    mostrarMensaje(`Reporte #${id} marcado como único`, 'info');
    
    const card = document.querySelector(`[data-id="${id}"]`);
    if (card) {
        card.classList.remove('similar');
        const similarBadge = card.querySelector('.similar-badge');
        if (similarBadge) {
            similarBadge.remove();
        }
    }
}

// === FUNCIONES DE MODAL ===

function mostrarModal() {
    document.getElementById('modal').classList.add('show');
}

function cerrarModal() {
    document.getElementById('modal').classList.remove('show');
}

// Cerrar modal al hacer clic fuera
window.onclick = function(event) {
    const modal = document.getElementById('modal');
    if (event.target === modal) {
        cerrarModal();
    }
};

// === FUNCIONES DE MENSAJES ===

function mostrarMensaje(texto, tipo = 'info') {
    const mensajeDiv = document.getElementById('mensaje');
    if (!mensajeDiv) return;
    
    mensajeDiv.textContent = texto;
    mensajeDiv.className = `mensaje ${tipo} show`;
    
    // Auto-ocultar después de 5 segundos
    setTimeout(() => {
        mensajeDiv.classList.remove('show');
    }, 5000);
}

// === FUNCIONES ADICIONALES ===

// Navegación por teclado
document.addEventListener('keydown', function(event) {
    if (event.target.tagName === 'INPUT' || event.target.tagName === 'TEXTAREA') {
        return; // No interferir cuando se está escribiendo
    }
    
    switch(event.key.toLowerCase()) {
        case 'h':
            window.location.href = 'index.html';
            break;
        case 'l':
            window.location.href = 'login.html';
            break;
        case 'r':
            window.location.href = 'report.html';
            break;
        case 'v':
            window.location.href = 'validation.html';
            break;
        case 'escape':
            cerrarModal();
            break;
    }
});

// Auto-guardar en formulario de reporte
let autoguardadoTimer;
function configurarAutoguardado() {
    const inputs = document.querySelectorAll('.report-form input, .report-form textarea, .report-form select');
    
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoguardadoTimer);
            autoguardadoTimer = setTimeout(() => {
                if (validarFormularioBasico()) {
                    guardarBorrador();
                }
            }, 5000); // Guardar después de 5 segundos de inactividad
        });
    });
}

function validarFormularioBasico() {
    const titulo = document.getElementById('titulo');
    const descripcion = document.getElementById('descripcion');
    
    return titulo && titulo.value.trim().length > 5 && 
           descripcion && descripcion.value.trim().length > 10;
}

// Inicializar auto-guardado si estamos en la página de reporte
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.report-form')) {
        configurarAutoguardado();
    }
});

console.log('Script cargado correctamente');