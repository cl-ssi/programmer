## Instalación Programador de Pabellones :hospital:

### Programas

- Instalar PHP >= 7.3
- Instalar Composer
- Instalar Git
- Descargar Extensión OCI 8 https://pecl.php.net/package/oci8 (descargar de acuerdo a la versión de PHP que se tiene 64 o 32)
- Descargar Instant Client de Oracle (descargar de acuerdo a la versión de PHP que se tenga instalada 64 o 32)
- (opcional) Instalar MySql

#### Configurar

- Agregar todos los programas al PATH
- Agregar la ruta del Instant Client al PATH
- En php.ini habilitar (descomentar) extención gd2, mbstring, pdo_sqlite, fileinfo, ssl
- En php.ini crear la siguiente linea en extensión extension=oci8
