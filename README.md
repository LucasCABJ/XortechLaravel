# XORTech E-commerce - Proyecto de Producción Web

Bienvenido al repositorio del proyecto XORTech E-commerce, desarrollado como parte de la materia de Producción Web con el profesor Fernando Gaitán.

## Descripción del Proyecto

XORTech es un E-commerce construido en Laravel 10 que permite la gestión de productos, usuarios y ventas. El proyecto implementa tres tipos de roles: Admin, Vendedor y Usuario, cada uno con sus respectivos permisos y funcionalidades.

## Características Principales

- **Gestión de Usuarios:** Admin puede gestionar usuarios, vendedores y usuarios pueden ver y actualizar sus perfiles.
- **Catálogo de Productos:** Productos organizados en categorías para una fácil navegación.
- **Roles y Permisos:** Tres roles implementados (Admin, Vendedor, Usuario) con permisos específicos.
- **Interfaz Intuitiva:** Diseño amigable y fácil de usar para una experiencia de usuario agradable.

## Autores

### - **[Lucas Caraballo](https://github.com/LucasCABJ)**
### - **[Juan Ignacio Pardo](https://github.com/JuaniPardo)**

## Pantalla de Inicio
![https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/home.png](https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/home.png)

## Pantalla de Registro
![https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/registro.png](https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/registro.png)

## Vista de Producto
![https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/product.png](https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/product.png)

## Edicion de Producto
![https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/edicion%20de%20prod.png](https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/edicion%20de%20prod.png)

## Gestión de Usuarios
![https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/Gestion%20de%20usuarios.png](https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/Gestion%20de%20usuarios.png)

## Carrito de Compras
![https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/carrito.png](https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/carrito.png)

## Avance del proyecto al 23-11-2023
[Tablero Trello (JSON)](https://raw.githubusercontent.com/LucasCABJ/XortechLaravel/main/TableroTrello.json)

## Instalación

1. Clona el repositorio en tu máquina local:

   ```bash
   git clone https://github.com/LucasCABJ/XortechLaravel.git
    ```
   2. Entra al directorio del proyecto:

   ```bash
   cd XortechLaravel
   ```
    3. Instala las dependencias:
    
    ```bash
    composer install
    ```
    4. Crea un archivo .env y copia el contenido del archivo .env.example:
    
    ```bash
    cp .env.example .env
    ```
    5. Genera una nueva clave de aplicación:
    
    ```bash
    php artisan key:generate
    ```
    6. Crea una base de datos y configura las credenciales en el archivo .env:
    
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ```
    7. Ejecuta las migraciones y los seeders:
    
    ```bash
    php artisan migrate --seed
    ```
    8. Inicia el servidor:
    
    ```bash
    php artisan serve
    ```
    9. Visita http://localhost:8000 en tu navegador.
   
 ## Acceso a Roles (Work in Progress)
- **Admin:**
  - Email:admin.gmail.com
  - Password:admin
- **Vendedor:**
  - Email:vendedor.gmail.com
  - Password:vendedor
- **Usuario:**
  - Email:usuario.gmail.com
  - Password:usuario

## Contribuciones
Las contribuciones son bienvenidas. Si encuentras algún problema o tienes alguna mejora, por favor, crea un issue o una pull request. 

