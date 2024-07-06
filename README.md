<!-- PROJECT LOGO -->

<h3 align="center">AFIP PHP Libre</h3>

<p align="center">
    Librería para conectarse a los Web Services de AFIP
    <br />
    <a href="https://github.com/adrianbarabino/afip-php-libre/wiki"><strong>Explorar documentación »</strong></a>
    <br />
    <br />
    <a href="https://github.com/adrianbarabino/afip-php-libre/issues">Reportar un bug</a>
  </p>
</p>

<!-- TABLE OF CONTENTS -->
## Tabla de contenidos

* [Acerca del proyecto](#acerca-del-proyecto)
* [Guía de inicio](#guía-de-inicio)
  * [Instalación](#instalación)
  * [Como usarlo](#como-usarlo)
* [Web Services](#web-services)
  * [Factura electrónica](#factura-electrónica)
  * [Padrón alcance 4](#padrón-alcance-4)
  * [Padrón alcance 10](#padrón-alcance-10)
  * [Padrón alcance 13](#padrón-alcance-13)
  * [Consulta Inscripción](#consulta-inscripcion-padron-a5)
  * [🎉 Otro web service](#otro-web-service)
* [Migración](#migración)
* [Proyectos relacionados](#proyectos-relacionados)
* [¿Necesitas ayuda? 🚀](#necesitas-ayuda-)
* [Licencia](#licencia)
* [Contacto](#contacto)

<!-- ABOUT THE PROJECT -->
## Acerca del proyecto

Esta librería fue creada con la intención de ayudar a los programadores a usar los Web Services de AFIP sin romperse la cabeza ni perder tiempo tratando de entender la complicada documentación que AFIP provee. La versión original pasó a ser un proyecto pago, pero como está bajo licencia MIT, hemos recuperado y liberado el código.

<!-- START GUIDE -->
## Guía de inicio

### Instalación

#### Via Composer

Podés instalar la librería utilizando Composer. Ejecutá el siguiente comando en tu terminal:

```bash
composer require adrianbarabino/afip-php-libre
```

#### Via Manual
1. Clonarlo con `git clone` o descargar el repositorio desde [aqui](https://github.com/adrianbarabino/afip-php-libre/archive/refs/heads/master.zip "Descargar repositorio").
2. Copiar el contenido de la carpeta *res* a tu aplicación.

**Importante**
* Reemplazar `Afip_res/cert` por tu certificado provisto por AFIP y `Afip_res/key` por la clave generada.
* Procurá que la carpeta `Afip_res` no sea accesible desde internet ya que allí se guardará toda la información para acceder a los web services. **Además, esta carpeta deberá tener permisos de escritura**.

Ir a http://www.afip.gob.ar/ws/documentacion/certificados.asp para obtener mas información de como generar la clave y certificado.

Si no pueden seguir la complicada documentación de AFIP para obtener el certificado pueden obtener [Afip SDK PRO](#necesitas-ayuda-) donde se explica cómo obtener los certificados fácilmente.

### Como usarlo

Si lo instalaste manualmente lo primero es incluir el SDK en tu aplicación
````php
include 'ruta/a/la/libreria/src/Afip.php';
````

Luego creamos una instancia de la clase Afip pasandole un Array como parámetro.
````php
$afip = new Afip(array('CUIT' => 20111111112));
````


Para más información acerca de los parámetros que se le puede pasar a la instancia new `Afip()` consulte sección [Primeros pasos](https://github.com/adrianbarabino/afip-php-libre/wiki/Primeros-pasos#como-usarlo) de la documentación

Una vez realizado esto podemos comenzar a usar el SDK con los Web Services disponibles


<!-- WEB SERVICES -->
## Web Services

Si necesitas más información de cómo utilizar algún web service echa un vistazo a la [documentación completa de afip-php-libre](https://github.com/adrianbarabino/afip-php-libre/wiki)

### Factura electrónica
Podes encontrar la documentación necesaria para utilizar la [facturación electrónica](https://github.com/adrianbarabino/afip-php-libre/wiki/Facturaci%C3%B3n-Electr%C3%B3nica) 👈 aquí

### Padrón alcance 4
El Servicio Web de Consulta de Padrón denominado A4 ha quedado limitado para Organismos Públicos, si lo necesitas puedes leer la documentación de [consulta al padrón de AFIP alcance 4](https://github.com/adrianbarabino/afip-php-libre/wiki/Consulta-al-padron-de-AFIP-alcance-4)

### Padrón alcance 10
Si tenes que utilizar este web service también está disponible dentro de la librería, su documentación se encuentra en [consulta al padrón de AFIP alcance 10](https://github.com/adrianbarabino/afip-php-libre/wiki/Consulta-al-padron-de-AFIP-alcance-10)

### Padrón alcance 13
Si debes consultar por el CUIT de una persona física tendrás que utilizar este web service, su documentación se encuentra disponible en la wiki de [consulta al padrón de AFIP alcance 13](https://github.com/adrianbarabino/afip-php-libre/wiki/Consulta-al-padron-de-AFIP-alcance-13)

### Consulta de Inscripción (Padrón A5)
Quienes usaban el padrón A4 pueden utilizar este padrón en modo de remplazo, si queres saber cómo echa un vistazo a la documentación de [consulta al padrón de AFIP alcance 5](https://github.com/adrianbarabino/afip-php-libre/wiki/Consulta-Inscripción)



<!-- LICENCE -->
### Licencia
Distribuido bajo la licencia MIT. Vea `LICENSE` para más información.

Este proyecto se basa en el trabajo original de Afip SDK (afipsdk@gmail.com).




_Este software y sus desarrolladores no tienen ninguna relación con la AFIP._

