# AgoraVote

AgoraVote es una aplicación web desarrollada con Laravel para la gestión de votaciones digitales en centros educativos.

El objetivo principal del proyecto es sustituir un sistema tradicional de votación en papel por una plataforma web que permita gestionar usuarios, roles, categorías, votaciones, secciones, opciones, emisión de votos, verificación mediante código, consulta de resultados, resultados en vivo y exportación de resultados.

Este proyecto ha sido desarrollado como Trabajo Final del ciclo de 2º Desarrollo de Aplicaciones Web en el IES Joan Coromines.

## Autor

Carlos de Martín Juan

## Descripción general

AgoraVote está orientada a centros educativos que necesitan organizar votaciones internas, como elecciones de representantes, consultas al alumnado, votaciones del profesorado o procesos participativos con familias.

La aplicación diferencia dos conceptos principales:

* Roles: determinan los permisos del usuario dentro de la aplicación.
* Categorías: determinan el colectivo electoral al que pertenece el usuario.

Por ejemplo, un usuario puede tener el rol de votante y pertenecer a la categoría Alumnado. Otro usuario puede tener el rol de admin y pertenecer a la categoría Administración.

Esta separación permite que el sistema controle por un lado quién puede administrar la aplicación y, por otro, en qué votaciones puede participar cada usuario.

## Funcionalidades implementadas

### Autenticación

La aplicación incluye un sistema de autenticación basado en Laravel Breeze. Permite iniciar sesión, cerrar sesión y acceder al perfil de usuario.

El registro público está desactivado. Los usuarios deben ser creados desde el panel de administración para garantizar que solo participen personas autorizadas por el centro educativo.

### Logo e interfaz personalizada

La aplicación cuenta con un logo personalizado de AgoraVote y una pantalla inicial adaptada al proyecto. También se ha personalizado la navegación principal para sustituir la interfaz inicial de Laravel por una presentación propia de la aplicación.

### Panel de administración

El panel de administración está protegido mediante middleware. Solo los usuarios con rol admin pueden acceder a las rutas de administración.

Desde el panel de administración se puede:

* Consultar un resumen general del sistema.
* Gestionar usuarios.
* Crear usuarios.
* Editar usuarios.
* Eliminar usuarios.
* Asignar roles a usuarios.
* Asignar categorías a usuarios.
* Crear votaciones.
* Editar votaciones.
* Añadir secciones y opciones de voto.
* Consultar resultados de las votaciones.
* Exportar resultados en formato CSV cuando la votación está cerrada.

### Gestión de usuarios

El administrador puede gestionar los usuarios desde el panel de administración. Desde esta sección puede crear nuevos usuarios, editar sus datos, modificar sus roles y categorías, y eliminar usuarios del sistema.

Al crear o editar un usuario se gestionan los siguientes datos:

* Nombre.
* DNI/NIE.
* Correo electrónico.
* Contraseña inicial o nueva contraseña.
* Rol.
* Categoría o categorías.

El DNI/NIE es obligatorio y único para cada usuario, lo que permite identificar de forma más precisa a las personas registradas dentro del sistema.

El sistema evita que el administrador elimine su propio usuario mientras está usando la sesión actual.

Los roles disponibles son:

* admin
* votante
* supervisor

Las categorías disponibles son:

* Alumnado
* Profesorado
* Familias
* Administración

### Gestión de votaciones

El administrador puede crear y editar votaciones indicando:

* Título.
* Descripción.
* Fecha de inicio.
* Fecha de finalización.
* Estado de la votación.
* Tipo de votación.
* Número máximo de selecciones.
* Si la votación es anónima.
* Si los resultados se muestran en tiempo real.
* Categorías autorizadas para participar.

Los estados principales de una votación son:

* draft: borrador.
* active: activa.
* closed: cerrada.
* archived: archivada.

### Edición de votaciones

El sistema permite editar una votación ya creada desde el panel de administración.

Desde la edición de una votación se pueden modificar sus datos principales, como título, descripción, fechas, estado, tipo de votación, anonimato, visibilidad de resultados en tiempo real, máximo de selecciones y categorías autorizadas.

### Cierre automático de votaciones

AgoraVote incluye un sistema de cierre automático basado en la fecha de finalización de la votación.

Cuando una votación está activa y su fecha de finalización ya ha pasado, el sistema cambia automáticamente su estado a cerrada.

Esta comprobación se realiza al acceder a zonas principales del sistema, como el listado de votaciones del administrador y el listado de votaciones del usuario. Además, si un usuario intenta votar después de que la votación haya caducado, el sistema impide el voto y muestra un mensaje indicando que la votación ya no está activa.

### Secciones y opciones de voto

Cada votación puede tener una o varias secciones. Cada sección contiene las opciones que podrán seleccionar los votantes.

Al crear una sección, el sistema exige un mínimo de dos opciones de voto. Las opciones adicionales son opcionales. Esto permite crear votaciones sencillas con solo dos opciones o votaciones más amplias con más alternativas.

Ejemplo:

Elección Consejo Escolar 2026

* Representantes del alumnado

  * Ana García
  * Marcos Pérez
  * Laura Sánchez
  * David Ruiz

### Emisión de voto

Los usuarios con rol votante pueden acceder a las votaciones activas asociadas a sus categorías.

El sistema controla que un usuario no pueda votar dos veces en la misma votación y con la misma categoría.

Después de votar, el sistema genera un código único de verificación.

### Verificación de voto

Después de emitir el voto, el usuario recibe un código de verificación. Desde la sección Verificar voto puede introducir ese código y comprobar que su participación ha sido registrada correctamente.

Para mantener la privacidad del voto, la verificación no muestra la opción seleccionada. Solo confirma que existe una participación registrada con ese código.

### Resultados

Desde el panel de administración se pueden consultar los resultados de cada votación.

La pantalla de resultados muestra:

* Total de votos emitidos.
* Participación por categoría.
* Resultados por opción.
* Porcentaje de votos de cada opción.

### Resultados en vivo para votantes

Si una votación tiene activada la opción de mostrar resultados en tiempo real, los votantes autorizados pueden consultar los resultados mientras la votación está activa.

En ese caso, el usuario ve un botón para acceder a los resultados en vivo desde el listado de votaciones o desde la pantalla de emisión de voto.

Si la votación no tiene activados los resultados en tiempo real, los votantes no pueden consultar los resultados durante el proceso.

### Exportación de resultados

Cuando una votación está cerrada, el administrador puede exportar los resultados en formato CSV.

La exportación incluye:

* Información general de la votación.
* Estado de la votación.
* Total de votos.
* Participación por categoría.
* Resultados por sección.
* Resultados por opción.
* Número de votos.
* Porcentaje de cada opción.

El archivo CSV puede abrirse desde Excel u otras hojas de cálculo.

## Tecnologías utilizadas

El proyecto utiliza las siguientes tecnologías:

* Laravel
* PHP
* Blade
* Laravel Breeze
* SQLite
* Eloquent ORM
* Tailwind CSS
* Vite
* Node.js
* Composer
* Git
* GitHub

## Requisitos previos

Para ejecutar el proyecto en local es necesario tener instalado:

* PHP
* Composer
* Node.js
* NPM
* Git

En Windows se puede utilizar XAMPP para disponer de PHP de forma sencilla.

## Instalación del proyecto

### 1. Clonar el repositorio

Clonar el repositorio desde GitHub:

```bash
git clone https://github.com/Perristation/AgoraVote.git
```

Entrar en la carpeta del proyecto:

```bash
cd AgoraVote
```

### 2. Instalar dependencias de PHP

Ejecutar:

```bash
composer install
```

### 3. Instalar dependencias de Node

Ejecutar:

```bash
npm install
```

### 4. Crear el archivo de entorno

En Windows:

```bash
copy .env.example .env
```

En Linux o Mac:

```bash
cp .env.example .env
```

### 5. Generar la clave de Laravel

Ejecutar:

```bash
php artisan key:generate
```

### 6. Configurar la base de datos SQLite

Crear el archivo de base de datos.

En Windows:

```bash
type nul > database\database.sqlite
```

En Linux o Mac:

```bash
touch database/database.sqlite
```

Después, abrir el archivo `.env` y configurar la conexión así:

```env
DB_CONNECTION=sqlite
```

Si aparecen variables de MySQL, se pueden comentar o eliminar:

```env
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

### 7. Ejecutar migraciones y datos iniciales

Ejecutar:

```bash
php artisan migrate:fresh --seed
```

Este comando crea todas las tablas necesarias y carga los datos iniciales de la aplicación.

Al ejecutar este comando, el sistema crea automáticamente:

* Roles.
* Categorías.
* Usuario administrador.
* Usuarios demo.
* Una votación de prueba llamada Elección Consejo Escolar 2026.
* Una sección de votación.
* Varias opciones de voto.

De esta forma, el proyecto queda preparado para ser probado sin tener que crear los datos manualmente.

### 8. Compilar recursos del frontend

Ejecutar:

```bash
npm run build
```

### 9. Iniciar el servidor local

Ejecutar:

```bash
php artisan serve
```

La aplicación estará disponible en:

```text
http://127.0.0.1:8000
```

## Credenciales de prueba

Después de ejecutar los seeders, se crean los siguientes usuarios de prueba.

Usuario administrador:

```text
Email: admin@agoravote.test
Contraseña: password
DNI/NIE: 00000000A
```

Usuario alumno:

```text
Email: alumno@agoravote.test
Contraseña: password
DNI/NIE: 11111111A
```

Usuario profesor:

```text
Email: profesor@agoravote.test
Contraseña: password
DNI/NIE: 22222222B
```

Usuario familia:

```text
Email: familia@agoravote.test
Contraseña: password
DNI/NIE: 33333333C
```

## Usuarios de prueba incluidos

El sistema incluye usuarios demo para facilitar la prueba de la aplicación.

Usuario alumno:

```text
Nombre: Alumno Demo
DNI/NIE: 11111111A
Email: alumno@agoravote.test
Contraseña: password
Rol: votante
Categoría: Alumnado
```

Usuario profesor:

```text
Nombre: Profesor Demo
DNI/NIE: 22222222B
Email: profesor@agoravote.test
Contraseña: password
Rol: votante
Categoría: Profesorado
```

Usuario familia:

```text
Nombre: Familia Demo
DNI/NIE: 33333333C
Email: familia@agoravote.test
Contraseña: password
Rol: votante
Categoría: Familias
```

## Guía rápida de uso

### 1. Acceder como administrador

Entrar en:

```text
http://127.0.0.1:8000/login
```

Usar las credenciales:

```text
Email: admin@agoravote.test
Contraseña: password
```

### 2. Gestionar usuarios

Desde el panel de administración:

```text
Panel admin → Gestionar usuarios
```

Desde esta sección el administrador puede consultar el listado de usuarios registrados en el sistema, crear nuevos usuarios, editar sus datos y eliminar usuarios.

Para crear un usuario nuevo:

```text
Panel admin → Gestionar usuarios → Nuevo usuario
```

Al crear un usuario se debe indicar:

* Nombre.
* DNI/NIE.
* Correo electrónico.
* Contraseña inicial.
* Rol.
* Categoría o categorías.

El DNI/NIE es obligatorio y no puede repetirse entre usuarios.

Para modificar un usuario existente, se utiliza el botón Editar del listado de usuarios. Desde esa pantalla se puede cambiar el nombre, el DNI/NIE, el correo electrónico, la contraseña, los roles y las categorías asignadas.

Para eliminar un usuario, se utiliza el botón Eliminar del listado. El sistema evita eliminar el propio usuario administrador que está usando la sesión actual.

### 3. Crear una votación

Desde el panel de administración:

```text
Panel admin → Gestionar votaciones → Nueva votación
```

Ejemplo de votación:

```text
Título: Elección Consejo Escolar 2026
Descripción: Votación para elegir representantes del consejo escolar.
Estado: Activa
Tipo: Varias opciones: una selección
Máximo de selecciones: 1
Categorías autorizadas: Alumnado, Profesorado, Familias
Recuento: Mostrar en tiempo real o mostrar al finalizar
```

### 4. Editar una votación

Desde el panel de administración:

```text
Panel admin → Gestionar votaciones → Editar
```

Desde esta pantalla se pueden modificar los datos principales de la votación, como título, descripción, fechas, estado, recuento, tipo de votación, máximo de selecciones y categorías autorizadas.

### 5. Programar cierre automático

Para programar el cierre automático de una votación, se debe indicar una fecha de finalización en el campo correspondiente.

Cuando la fecha de finalización pasa y la votación está activa, el sistema cambia automáticamente su estado a cerrada.

Ejemplo:

```text
Estado: Activa
Fecha de finalización: 10/06/2026 12:00
```

Cuando el sistema detecta que esa fecha ya ha pasado, la votación se cambia automáticamente a estado cerrada.

### 6. Añadir secciones y opciones

Entrar en la votación creada y pulsar:

```text
Añadir sección/opciones
```

Ejemplo:

```text
Título de sección: Representantes del alumnado
Descripción: Candidatos disponibles para representar al alumnado.
Máximo de selecciones: 1

Opciones obligatorias:
- Ana García
- Marcos Pérez

Opciones adicionales:
- Laura Sánchez
- David Ruiz
```

El sistema permite crear una sección con un mínimo de dos opciones. Las opciones adicionales pueden dejarse vacías.

### 7. Votar como usuario

Cerrar sesión como administrador e iniciar sesión con un usuario votante.

Entrar en:

```text
Votaciones
```

Seleccionar una votación activa, elegir una opción y confirmar el voto.

Al finalizar, el sistema mostrará un código de verificación.

### 8. Ver resultados en vivo

Si la votación tiene activado el recuento en tiempo real, el votante podrá acceder a los resultados desde:

```text
Votaciones → Ver resultados
```

También podrá ver el botón de resultados en vivo dentro de la pantalla de emisión del voto.

### 9. Verificar voto

Entrar en:

```text
Verificar voto
```

Introducir el código generado después de votar.

El sistema confirmará si el voto está registrado.

### 10. Consultar resultados como administrador

Entrar como administrador.

Ir a:

```text
Panel admin → Gestionar votaciones → Seleccionar votación → Ver resultados
```

Se mostrarán:

* Votos totales.
* Participación por categoría.
* Votos por opción.
* Porcentaje de cada opción.

### 11. Exportar resultados

Cuando una votación está cerrada, el administrador puede exportar los resultados desde:

```text
Panel admin → Gestionar votaciones → Seleccionar votación → Ver resultados → Exportar resultados CSV
```

El archivo exportado contiene información general de la votación, participación por categoría y resultados por opción.

## Estructura principal del proyecto

```text
AgoraVote/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ElectionController.php
│   │   │   │   ├── ElectionSectionController.php
│   │   │   │   ├── ResultController.php
│   │   │   │   └── UserController.php
│   │   │   ├── VoteController.php
│   │   │   └── VoteVerificationController.php
│   │   └── Middleware/
│   │       └── IsAdmin.php
│   └── Models/
│       ├── User.php
│       ├── Role.php
│       ├── Category.php
│       ├── Election.php
│       ├── ElectionSection.php
│       ├── VoteOption.php
│       ├── Participation.php
│       ├── Vote.php
│       └── AuditLog.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   └── images/
│       └── agoravote-logo.png
├── resources/
│   └── views/
│       ├── admin/
│       ├── votes/
│       ├── dashboard.blade.php
│       └── welcome.blade.php
├── routes/
│   └── web.php
├── composer.json
├── package.json
└── README.md
```

## Modelo de base de datos

El sistema utiliza las siguientes tablas principales:

* users
* roles
* role_user
* categories
* category_user
* elections
* category_election
* election_sections
* vote_options
* participations
* votes
* vote_option
* audit_logs

La base de datos separa la participación del usuario y el voto emitido. Esto permite comprobar que un usuario ha votado sin mostrar directamente la opción seleccionada en la verificación.

La tabla de usuarios incluye un campo DNI/NIE único, utilizado como identificador administrativo adicional junto al nombre y el correo electrónico.

## Seguridad implementada

El proyecto incluye las siguientes medidas:

* Autenticación mediante Laravel Breeze.
* Registro público desactivado.
* Identificación de usuarios mediante DNI/NIE único.
* Contraseñas cifradas.
* Middleware para proteger el panel de administración.
* Acceso al panel admin solo para usuarios con rol admin.
* Validación de formularios.
* Control de voto duplicado.
* Bloqueo de voto cuando la votación ya no está activa.
* Cierre automático de votaciones caducadas.
* Separación entre participación y voto.
* Código único de verificación.

## Estado actual del proyecto

El proyecto incluye actualmente:

* Login.
* Registro público desactivado.
* Dashboard personalizado.
* Logo personalizado de AgoraVote.
* Panel admin protegido.
* Gestión de usuarios: creación, edición y eliminación con DNI/NIE obligatorio.
* Gestión de roles y categorías.
* Creación de votaciones.
* Edición de votaciones.
* Cierre automático de votaciones según fecha de finalización.
* Creación de secciones con mínimo de dos opciones y opciones adicionales opcionales.
* Creación de secciones y opciones.
* Emisión de voto.
* Bloqueo de voto duplicado.
* Bloqueo de voto fuera de plazo.
* Código de verificación.
* Verificación de voto.
* Resultados en vivo para votaciones configuradas con recuento en tiempo real.
* Consulta de resultados.
* Exportación CSV de resultados en votaciones cerradas.
* Datos demo mediante seeders.

## Mejoras futuras

Algunas posibles mejoras futuras son:

* Eliminación o edición avanzada de secciones y opciones.
* Exportación de resultados en PDF.
* Gráficos avanzados.
* Panel específico para supervisores.
* Despliegue en servidor externo.
* Uso de MySQL o PostgreSQL en producción.
* Envío de credenciales por correo.
* Auditoría avanzada.
* Notificaciones automáticas al cerrar una votación.

## Licencia

Proyecto desarrollado con finalidad académica como Trabajo Final de 2º Desarrollo de Aplicaciones Web.

## Autor

Carlos de Martín Juan
2º Desarrollo de Aplicaciones Web
IES Joan Coromines
