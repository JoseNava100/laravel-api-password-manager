<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# API REST para la gestion de contraseñas

Este proyecto es una API REST desarrollada en Laravel para la gestión de contraseñas y generación de contraseñas, mediante usuarios. Utiliza **Sanctum** para la autenticación de usuarios, permitiendo un acceso seguro mediante login. Está diseñado como un entorno backend y puede ser integrado con frameworks frontend como **React** o **Next.js**.

## Características

- **Autenticación segura**: Implementación de autenticación basada en tokens con Laravel Sanctum.
- **CRUD completo**: Operaciones de creación, lectura, actualización y eliminación para los recursos de las tareas asignadas.
- **Arquitectura escalable**: Diseñado para integrarse fácilmente con cualquier frontend moderno.
- **Documentación de endpoints**: Incluye una colección de Postman para facilitar el uso de la API.

## Requisitos previos

- PHP >= 8.1
- Composer
- MySQL o cualquier base de datos compatible
- Laravel 11
- Node.js (opcional, para integraciones frontend)

## Instalación

1. Clona este repositorio:
   ```bash
   git clone https://github.com/JoseNava100/laravel-api-password-manager
   cd laravel-api-password-manager
   ```

2. Instala las dependencias de PHP:
   ```bash
   composer install
   ```

3. Configura el archivo `.env`:
   - Copia el archivo de ejemplo:
     ```bash
     cp .env.example .env
     ```
   - Configura las variables de entorno, como la conexión a la base de datos.

4. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```

5. Ejecuta las migraciones para crear las tablas necesarias:
   ```bash
   php artisan migrate
   ```

6. (Opcional) Llena la base de datos con los datos de prueba configurados:
   ```bash
   php artisan db:seed
   ```

7. Inicia el servidor de desarrollo:
   ```bash
   php artisan serve
   ```

## Endpoints principales

| Método | Endpoint           | Descripción                     | Autenticación |
|--------|--------------------|---------------------------------|---------------|
| POST   | `/api/register`    | Registrar un nuevo usuario      | No            |
| POST   | `/api/login`       | Iniciar sesión y obtener token  | No            |
| GET    | `/api/passwords`        | Listar todas las contraseñas         | Sí            |
| POST   | `/api/passwords`        | Crear una nueva contraseña            | Sí            |
| GET    | `/api/passwords/{id}`   | Obtener detalles de una contraseña    | Sí            |
| PUT/PATCH    | `/api/passwords/{id}`   | Actualizar una contraseña existente   | Sí            |
| DELETE | `/api/passwords/{id}`   | Eliminar una contraseña               | Sí            |
| POST   | `/api/logout`      | Cerrar sesión                   | Sí            |

## Autenticación

Este proyecto utiliza **Laravel Sanctum** para la autenticación basada en tokens. Asegúrate de incluir el token en el encabezado de cada solicitud autenticada:

```http
Authorization: Bearer <tu-token>
```

## Integración con Frontend

Esta API está preparada para ser consumida por frameworks frontend como **React** o **Next.js**. Puedes realizar solicitudes HTTP utilizando bibliotecas como **Axios** o **Fetch API**.

### Ejemplo de solicitud con Axios

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://127.0.0.1::8000/api',
  headers: {
    Authorization: `Bearer ${tuToken}`,
  },
});

// Obtener todos los carros ejemplo
api.get('/cars')
  .then(response => console.log(response.data))
  .catch(error => console.error(error));
```

## Creador

Este proyecto fue creado por [JoseNava100](https://github.com/JoseNava100/laravel-sanctum-api-rest).