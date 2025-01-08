# Proyecto: Caso Práctico Total Renting

## Descripción
Este proyecto incluye:

1. **Maquetación de una página modelo** para ser utilizada como plantilla en un tipo de contenido personalizado basado en WordPress.
2. **Página interactiva de mapas** que utiliza una API para mostrar puntos de repostaje. Los puntos se actualizan en función de la dirección de origen y destino introducida por el usuario. Además, se incluye la funcionalidad para agregar nuevos puntos al mapa.

## Estructura del Proyecto

- **`/`**: La carpeta raíz contiene todos los archivos necesarios para instalar wordpress y desplegar el sistema correctamente.
- **`database/`**: Contiene la base de datos utilizada en el proyecto.
- **`screenshot/`**: Incluye capturas de pantalla que muestran el diseño y funcionalidad de las páginas desarrolladas.

## Requisitos Cumplidos

1. **Control de versiones**: Se realizaron al menos 4 commits significativos en GitHub.
2. **Integración API**: La página de mapas se conecta a una API de google maps que permite:
   - Mostrar todos los puntos de repostaje inicialmente.
   - Filtrar y mostrar puntos únicamente en rutas específicas.
3. **Interactividad**: Se habilitó la funcionalidad para agregar nuevos puntos de repostaje al mapa.

## Instalación y Configuración

1. Clonar este repositorio desde GitHub:
   ```bash
   git clone <URL_DEL_REPOSITORIO>
   ```
2. Configurar la base de datos ubicada en `database/` según las instrucciones de configuración.
3. Usuario base de datos: u244378464_42SXY. Contraseña base de datos: GpnMIEHFYe. Nombre base de datos: u244378464_42SXY
4. Asegurarse de que el servidor tenga acceso a la API utilizada para la funcionalidad del mapa.
5. Verificar la configuración del tema de WordPress para integrar la página modelo como plantilla.
6. Pueden visitar el sitio en vivo en la url: https://skyblue-elephant-250107.hostingersite.com/
7. Usuario administrador: contacto@pgweb.com.ve, contraseña: HOlasoy.25

## Capturas de Pantalla
Las vistas del diseño y funcionalidad se encuentran disponibles en la carpeta `screenshot/`.

## Tecnologías Utilizadas
- **WordPress**: Para la creación de la página modelo.
- **API de google maps**: Para la visualización y gestión de puntos de repostaje.
- **Javascript**: Para consumir la api realizar las funcionalidades interactivas.
- **PHP**: Para crear shortcodes y logica complementaria con WordPress.
- **Git**: Para el control de versiones.

## Contribución
Si deseas contribuir, por favor crea un fork de este repositorio, realiza tus cambios, y envía un pull request.

---
© 2025 - Desarrollado por Pedro Henriquez.

