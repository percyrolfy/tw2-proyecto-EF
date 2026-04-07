#  App de Tareas - CakePHP 5

Aplicación web de gestión de tareas por usuario desarrollada con **CakePHP 5**.  
Permite registro de usuarios, autenticación, gestión de tareas y soporte multilingüe.

---

#  Características principales

-  Registro e inicio de sesión de usuarios  
-  Perfil con idioma configurable:
  - Español, Inglés, Francés, Portugués, 
-  CRUD de tareas (crear, ver, editar, eliminar)  
-  Filtros por:
  - estado  
  - fecha límite  
  - texto  
-  Descripciones bilingües por tarea  
-  Control de acceso por usuario  

---

#  Requisitos

- PHP 8.2 o superior  
- Composer  
- MariaDB o MySQL 5.7+  
- Apache con mod_rewrite o servidor integrado de CakePHP  

---

#  Instalación

## 1 Clonar el repositorio

git clone https://github.com/percyrolfy/tw2-proyecto-EF.git  
cd tw2-proyecto-EF  

---

## 2 Instalar dependencias

composer install  

---

## 3 Configurar base de datos

Copiar archivo de configuración:

cp config/app_local.example.php config/app_local.php  

Editar credenciales en:

Datasources → host, username, password, database  

---

## 4 Crear base de datos

Crear una base vacía en MariaDB/MySQL.

---

## 5 Aplicar esquema

###  Opción A (Recomendada)

bin/cake migrations migrate  

###  Opción B (Manual)

Ejecutar:

config/schema/entregable_tareas.sql  

---

## 6 (Opcional) Variables de entorno

cp config/.env.example config/.env  

---

#  Ejecución

##  Servidor CakePHP

bin/cake server -p 8765  

Abrir en navegador:

http://localhost:8765  

---

##  Apache

Configurar:

DocumentRoot → webroot/  

---

#  Despliegue con Podman

##  Descripción

Contenerización de la aplicación usando Podman con imagen basada en PHP + Apache.

---

##  Tecnologías

- PHP 8.2 + Apache  
- CakePHP  
- Podman  
- Podman Compose  
- Linux  

---

##  Estructura

devops/  
├── Dockerfile  
├── compose.yml  
└── app_ef/  

---

##  Implementación

## 11️ Crear carpeta

mkdir ~/devops/  
cd ~/devops/  

---

## 22️ Copiar aplicación

Colocar proyecto en:

app_ef/  

---

## 3 Dockerfile

FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libicu-dev \
    && docker-php-ext-install intl pdo pdo_mysql mysqli

RUN a2enmod rewrite

COPY app_ef/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

EXPOSE 80  

---

## 4 compose.yml

services:  
  php-app:  
    image: ef-app  
    container_name: ef-app  
    ports:  
      - "8080:80"  
    restart: unless-stopped  

---

## 55️ Configuración de red (opcional)

Editar:

sudo nano /etc/containers/containers.conf  

Agregar:

[engine]  
network_cmd = "host"  

---

##6️6 Construir imagen

podman build -t ef-app .  

---

##7️7 Ejecutar contenedor

podman-compose up  

---

##8️8 Acceso

http://localhost:8080  

---

#  Comandos útiles

sudo ss -tuln        → Ver puertos  
podman ps           → Contenedores activos  
podman logs ef-app  → Logs  

---

#  Problemas solucionados

-  Error COPY → ✔ ruta corregida  
-  Falta intl → ✔ instalada  
-  Error MySQL → ✔ pdo_mysql agregado  
-  Imagen inexistente → ✔ build ejecutado  

---

#  Base de datos

- users → usuarios  
- perfiles → idioma, biografía  
- tareas → tareas por usuario  

---

#  Uso del sistema

- Registro → enlace "Registrar"  
- Login → `/`  
- Tareas → gestión individual  
- Perfil → cambio de idioma  
- Módulos extra → países, usuarios  

---

#  Documentación

- docs/INFORME_IMRD.md  
- docs/BITACORA_IA.md  
- docs/EVIDENCIAS.md  

---

#  Autor

Proyecto desarrollado para la materia **Tecnología Web II**.

---

#  Licencia

MIT Licencia (como la pagina oficial de CakePHP).
