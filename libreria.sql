-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2016 a las 10:44:53
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `idproducto` int(11) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `disponibles` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `descripcion` text(5000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`idproducto`, `autor`,`imagen`, `nombre`, `disponibles`, `precio`, `descripcion`) VALUES
(3, 'Antonia J. Corrales','lib3.jpg','EN UN RINCON DEL ALMA',25,5,'Una obra en la que los sentimientos, la intriga emocional, junto a una crítica social empapada de ironía y humor, conforman una historia que nos evoca grandes obras como "Memorias de África", "Tomates verdes fritos", "Como agua para chocolate", "Los puentes de Madison"… Una historia, actual, entrañable, divertida y cargada de realidad cotidiana que no dejará indiferente a nadie y en la que todas las mujeres se verán identificadas sin excepción y algunos hombres, sólo los elegidos, encontrarán respuestas a muchos interrogantes. «Una novela estremecedora en la que el destino, el amor y la muerte marcan a sus protagonistas.» Clara Tahoces, periodista y escritor2a'),
(10,'Estefania Yepes','lib10.jpg','QUIERO QUE CONOZCAS A ALGUIEN',15,14.,'Su historia empezó un verano. Aquellos besos robados fueron el sustento y su amor, la perdición. Sin embargo, el destino quiso que se alejara de ella sin dejar ninguna huella tras sus pasos. 

Ahora han transcurrido veintiséis años desde que sucedió y Elsa, joven, entusiasta y soñadora, continúa sin conocer el verdadero origen de su pasado. 

No obstante, las casualidades harán que se cruce en su camino Luca, un enigmático joven que pondrá en jaque aquello que ella había creído real hasta el momento. 

Después de sentirse abrumada por la magnitud de sus descubrimientos, Elsa decide alejarse de su vida para intentar poner orden a lo que siente por Bosco, su mejor amigo, y lo que supone la aparición repentina de Luca en su vida, mientras trata de descifrar si es cierto todo lo que su madre siempre le había contado. 

¿Podrías olvidar tu pasado y empezar de cero?'),
(5,'Patricia Sutherland','lib5.jpg','BOMBON',50,13.3,'Mandy y Jordan son amigos desde niños. Pudieron haber sido novios adolescentes, pero él no acudió a la cita. Ahora ella tiene 26 años, es una cantante famosa, y Jordan, además de su amigo, es su mánager.

Desde hace dos años, Mandy alimenta a la prensa sensacionalista con escándalos frecuentes y no atiende a razones. Una noche, Jordan la encuentra en su suite del hotel compartiendo cama con el licencioso vocalista de una banda de rock, y decide marcharse. Cuando Mandy quiere darse cuenta, Jordan se ha ido y su vida es un desastre.

Para Jordan, marcharse fue un intento de pasar página: cada vez más atrapado en la red de un amor no correspondido, ya no sabe qué hacer. Pero al tiempo, cuando vuelven a verse y Mandy se muestra arrepentida por lo ocurrido, y poco después reacciona tan mal al comprobar que él ha asistido con una amiga a la entrega de premios en la que Mandy es una de la nominadas, se enciende una pequeñísima luz de esperanza... ¿Son celos? ¿Qué posibilidades tiene de enamorar a esa mujer arisca que cambia de acompañante como de zapatos, cuya relación más larga duró apenas una semana?'),
(9,'Dolores Redondo','lib9.jpg','EL GUARDIAN INVISIBLE',13,9.45,'En los márgenes del río Baztán, en el valle de Navarra, aparece el cuerpo desnudo de una adolescente en unas circunstancias que lo ponen en relación con un asesinato ocurrido en los alrededores un mes atrás.

La inspectora de la sección de homicidios dela Policía Foral, Amaia Salazar, será la encargada de dirigir una investigación que la llevará devuelta a Elizondo, una pequeña población de donde es originaria y de la que ha tratado dehuir toda su vida. Enfrentada con las cada vez más complicadas derivaciones del caso y con sus propios fantasmas familiares, la investigación de Amaia es una carrera contrarreloj para dar con un asesino que puede mostrar el rostro más aterrador de una realidad brutal al tiempo que convocar a los seres más inquietantes de las leyendas del Norte.'),
(4,'Dolores Redondo','lib4.jpg','TODO ESTO TE DARÉ',25,12.34,'En el escenario majestuoso de la Ribeira Sacra, Álvaro sufre un accidente que acabará con su vida. Cuando Manuel, su marido, llega a Galicia para reconocer el cadáver, descubre que la investigación sobre el caso se ha cerrado con demasiada rapidez. El rechazo de su poderosa familia política, los Muñiz de Dávila, le impulsa a huir pero le retiene el alegato contra la impunidad que Nogueira, un guardia civil jubilado, esgrime contra la familia de Álvaro, nobles mecidos en sus privilegios, y la sospecha de que ésa no es la primera muerte de su entorno que se ha enmascarado como accidental. Lucas, un sacerdote amigo de la infancia de Álvaro, se une a Manuel y a Nogueira en la reconstrucción de la vida secreta de quien creían conocer bien.'),
(6,'José Luis Sampedro','lib6.jpg','LA BALADA DEL AGUA',31,10.05,'En 2008, y con motivo de la Exposición Internacional de Zaragoza, escribió La balada del agua, una delicada fábula alegórica en la que los cuatro elementos se reúnen y discuten sobre el futuro de la Humanidad.

Como recuerda Olga Lucas, «su primera idea fue escribir un ensayo divulgativo que sirviera además a maestros y profesores para concienciar a los más jóvenes. Pero en uno de sus viajes a Andalucía, la belleza de un geranio espectacular despertó su sensibilidad poética y el ensayo se transformó en balada, en esta Balada del agua, y en embrión de Cuarteto para un solista.»

Traducida al inglés y al francés, se presentó en una edición trilingüe en la misma Expo de Zaragoza. Diez años después, Penguin Random House quiere homenajear a José Luis Sampedro en el centenario de su nacimiento recuperando este hermoso texto y obsequiándoselo a sus fieles lectores.'),
(7,'Luz Gabás','lib7.jpg','COMO FUEGO EN EL HIELO',15,19.95,'El fatídico día en el que Attua tuvo que ocupar el lugar de su padre supo que su prometedor futuro se había truncado. Ahora debía regentar las termas que habían sido el sustento de su familia, en una tierra fronteriza a la que él nunca hubiera elegido regresar. Junto al suyo, también se frustró el deseo de Cristela, quien anhelaba una vida a su lado y, además, alejarse de su insoportable rutina en un entorno hostil. Un nuevo revés del destino pondrá a prueba el irrefrenable amor entre ellos; y así, entre malentendidos y obligaciones, decisiones y obsesiones, traiciones y lealtades, Luz Gabás teje una bella historia de amor, honor y superación.'),
(2,'Fernando Aramburu','lib2.jpg','PATRIA',30,9.49,'El día en que ETA anuncia el abandono de las armas, Bittori se dirige al cementerio para contarle a la tumba de su marido el Txato, asesinado por los terroristas, que ha decidido volver a la casa donde vivieron. ¿Podrá convivir con quienes la acosaron antes y después del atentado que trastocó su vida y la de su familia? ¿Podrá saber quién fue el encapuchado que un día lluvioso mató a su marido, cuando volvía de su empresa de transportes? Por más que llegue a escondidas, la presencia de Bittori alterará la falsa tranquilidad del pueblo, sobre todo de su vecina Miren, amiga íntima en otro tiempo, y madre de Joxe Mari, un terrorista encarcelado y sospechoso de los peores temores de Bittori. ¿Qué pasó entre esas dos mujeres? ¿Qué ha envenenado la vida de sus hijos y sus maridos tan unidos en el pasado? Con sus desgarros disimulados y sus convicciones inquebrantables, con sus heridas y sus valentías, la historia incandescente de sus vidas antes y después del cráter que fue la muerte del Txato, nos habla de la imposibilidad de olvidar y de la necesidad de perdón en una comunidad rota por el fanatismo político.'),
(8,'Nieves García Bautista','lib8.jpg','EL AMOR HUELE A CAFE',47,15.2,'El amor es como el buen café: ardiente, poderoso, puro, amargo y dulce. Para apreciarlo hay que acostumbrarse a él sorbo a sorbo y solo se disfruta plenamente después de descubrir hasta sus más pequeños matices.

Una pequeña cafetería y una gitana de inquietantes ojos verdes escoltan las historias de una estudiante universitaria inadaptada, dos profesionales en la treintena obsesionadas por el éxito personal y un jubilado torturado por la pérdida que aún tienen mucho que descubrir.

Son historias cotidianas e íntimas sobre la búsqueda de una felicidad que se escapa entre la frustración, los sueños rotos y la rutina del día a día. El pasado puede doler, pero siempre se puede aprender de él.'),
(1,'Khaled Hosseini','lib1.jpg','MIL SOLES ESPLENDIDOS',1000,8.54,'Hija ilegítima de un rico hombre de negocios, Mariam se cría con su madre en una modesta vivienda a las afueras de Herat. A los quince años, su vida cambia drásticamente cuando su padre la envía a Kabul a casarse con Rashid, un hosco zapatero treinta años mayor que ella. Casi dos décadas más tarde, Rashid encuentra en las calles de Kabul a Laila, una joven de quince años sin hogar. Cuando el zapatero le ofrece cobijo en su casa, que deberá compartir con Mariam, entre las dos mujeres se inicia una relación que acabará siendo tan profunda como la de dos hermanas, tan fuerte como la de madre e hija. Pese a la diferencia de edad y las distintas experiencias que la vida les ha deparado, la necesidad de afrontar las terribles circunstancias que las rodean —tanto de puertas adentro como en la calle, donde la violencia política asola el país—, hará que Mariam y Laila vayan forjando un vínculo indestructible que les otorgará la fuerza necesaria para superar el miedo y dar cabida a la esperanza.');



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

--
-- Contraseña: 1234
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `clave`, `tipo`) VALUES
(1, 'jpferre', '*A4B6157319038724E3560894F7F932C8886EBFCF', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`idproducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
