<h1 align=center>Letterfly</h1>

=======
# Panel de Administración de Letterfly
[![Twitter - Adrifer24](https://img.shields.io/badge/Twitter-Adrifer24-black?logo=x)](https://x.com/Adri_fer24)
[![Discord - Letterfly](https://img.shields.io/badge/Discord-Letterfly-blue?logo=discord)](https://discord.gg/Z5NvzV8MAD)
[![PHP - 7.4](https://img.shields.io/badge/PHP-7.4-green?logo=php)](https://www.php.net/releases/7_4_0.php)


Una plataforma web para guardar, organizar y descubrir **reseñas de libros**.


=======
El panel de administración de **Letterfly** (`admin.letterfly.net`). Aquí podrás gestionar usuarios, libros, reseñas y propuestas enviadas por la comunidad.

---

## ✨ Características principales

* **Usuarios**: listar, resetear contraseñas, banear.
* **Libros**: editar y eliminar libros.
* **Reseñas**: eliminar comentarios inapropiados.
* **Propuestas**: aceptar o rechazar libros sugeridos por los usuarios.
* **Seguridad**: acceso protegido por **Authelia** + cookies de sesión de 30 días.

---

## 🚀 Funcionalidades

- 🔐 Registro e inicio de sesión con control de acceso
- 🧠 Gestión de libros: portada, título, descripción, autor, género, etc.
- 🧾 Filtro por género y búsqueda por título
- 📄 Página de detalle con toda la información del libro
- 👍 Sistema de Reseñas (en desarrollo)
- 📱 Diseño responsive con Bootstrap

---

## 🖼️ Capturas

![detalle](https://github.com/user-attachments/assets/c385fcd5-7e86-424b-b370-5b7cbb295071)


---

## 🛠️ Tecnologías utilizadas

- PHP 7.4
- MySQL / MariaDB
- Bootstrap 5
- HTML5 + CSS3
- (EL minimo posible porque no lo entiendo) JavaScript
=======
## 🚀 Requisitos

| Componente    | Versión / Nota                               |
| ------------- | -------------------------------------------- |
| **PHP**       | 7.4 (procedimental)                          |
| **MySQL**     | 5.7 +                                        |
| **Bootstrap** | 5.3 (CDN)                                    |
| **Authelia**  | Configurado en Caddy (fuera del repositorio) |

---

## ⚙️ Instalación local (dev)

1. Clona el repositorio:

   ```bash
   git clone https://github.com/Adrifer24/admin_letterfly.git
   cd admin_letterfly
   ```
2. Copia `config/conexion_example.php` a `config/conexion.php` y ajusta credenciales.
3. Copia `config/config_example.php` a `config/config.php` y ajusta credenciales.
4. Utilizando Apache levanta el servidor PHP
---

## 📝 Licencia

Este proyecto se distribuye bajo la **GNU Affero General Public License v3.0 (AGPL‑3.0)**.

---

## 🤝 Contribuir

1. Crea una rama a partir de `main`:

   ```bash
   git checkout -b fix/tu-parche
   ```
2. Sigue la guía de commits convencionales.
3. Abre un Pull Request. Usa `Fixes #N` o `Closes #N` para cerrar issues.

---

## 📅 Historial de versiones

* **1.0.1** – Hardening de contraseñas + cierre de sesión al ban. (EN PROCESO)
* **1.0.0** – Versión inicial del panel (NO PUBLICADA)

## 🙋‍♀️🙋‍♂️ Gracias
[![IG - laau.books](https://img.shields.io/badge/Instagram-laau.books-pink?logo=instagram)](https://www.instagram.com/laau.books/?igsh=em5hMHVmeWh1d2V3)
