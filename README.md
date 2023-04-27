/**
 * Breve explicación del desarrollo realizado
 * @author Josué Abraham Gutiérrez Quino <josuandroidg7@gmail.com>
 * @date 2023-04-26
 * @Laravel version 9.0 
 */
 
 Muy buenas noches, pues a continuación voy a detallar el proceso sin extenderme tanto, pero siendo claro en cada punto que se denote.
 
- Paso 1 : Para empezar construí la estructura de la base de datos (incluídas sus restricciones referenciales e indexación) en base a los archivos de referencia proporcionados. Se determinó que eran necesarias 5 tablas las cuales son:
  * federal_entities (Entidades federativas) : Tabla individual que sirve para la relación 1:1 en los zip_codes
  * municipalities (Municipos): Tabla individual que sirve para la relación 1:1 en los zip_codes
  * zip_codes (Códigos ZIP): Tabla principal de consulta que tiene como datos únicos al código y al nombre que tiene relación 1:N con settlement_types
  * settlement_types (Tipos de asentamiento): Tabla individual que sirve para la relación 1:1 en settlements
  * settlements (Asentamientos): Tabla N:1 que tiene relación con los zip_codes y una relación 1:1 con settlement_types
- Paso 2: Después generado el migrate, se procedió a crear los modelos de cada tabla respetictamente con sus relaciones.
- Paso 3: Se creo una función en los seeders para el cargado de información de estas tablas, en mi caso use el archivo con la extensión ".txt" ya que es un texto plano con saltos de linea y no es necesario ningún paquete extra para lectura de archivos, solo las funciones por defecto que trae php. 
Se iteró sobre cada linea de este archivo y también se considero que en todas las palabras exceptuando en el tipo de asentamiento los acentos no son considerados, por tal motivo se hizo una conversión a mayúsculas del texto y se hizo otra conversión en este caso de palabras con acento a palabras sin acento, todo esto con una función sencilla.
- Paso 4: Creamos un comando deploy para ejecutar tanto el migrate como el seeder en uno solo (en el archivo DatabaseSeeder es donde se hizo todo el proceso para cargar la información.
- Paso 5: El servicio o api para consumo está en el archivo por defecto que se usa para consumo de apis (routes/api.php) y la función que acompaña a esta ruta se hace en 2 lineas básicamente, una consulta firstOrFail para verificar si existe el código postal enviado en el único parámetro de la ruta y toda la data que acompaña al código ZIP, como ser el municipio (1:1), entidades federativas (1:1), asentamientos (1:N), toda está lógica está en el modelo, gracias al atributo $with que tienen todos los modelos creados justamente para las respuestas tipo json, en el modelo \App\Model\ZipCode definimos que relaciones tiene el modelo por defecto, dejando así nuestra función de consulta de código zip en solo 2 lineas y dejando toda la lógica en los modelos.
- Paso 6: Se subió el proyecto sobre la base de un servidor nginx con ubuntu 22 y php 8.1.

El link de consulta es https://job-challenge-josue.live/api/zip-codes/{zip_code} y la verdad gracias por considerarme para la realización de este reto, estaré atento a su respuesta y preguntas que les puedan surgir

Muchas gracias!!
