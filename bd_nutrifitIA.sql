-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.20 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bd_nutricional_ia
CREATE DATABASE IF NOT EXISTS `bd_nutricional_ia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bd_nutricional_ia`;

-- Volcando estructura para tabla bd_nutricional_ia.conversations
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conversations_user_id_foreign` (`user_id`),
  CONSTRAINT `conversations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.conversations: ~18 rows (aproximadamente)
REPLACE INTO `conversations` (`id`, `uuid`, `title`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(20, '4e41f5c2-c903-45ca-b389-018c5ee1dc95', 'Plan Nutricional Personalizado', 4, '2024-11-09 05:44:18', '2024-11-09 05:45:13', NULL),
	(21, '431b8fe4-8d60-4731-9c44-0f8fe2c07ae8', 'Vector implementation using OOP in C++', 4, '2024-11-09 06:31:44', '2024-11-09 06:32:17', NULL),
	(22, '714f7923-ae97-4a17-b544-029119492e26', 'Plan de dieta', 4, '2024-11-09 08:10:05', '2024-11-09 08:10:37', NULL),
	(23, '9677551f-08d9-4159-854a-9a41fe1bb17d', NULL, 4, '2024-11-09 15:10:14', '2024-11-09 15:10:14', NULL),
	(24, '6213ea9d-ef93-4224-ae6e-4802a38df17f', NULL, 4, '2024-11-09 17:31:42', '2024-11-09 17:31:42', NULL),
	(25, 'b3569da5-55dd-4fb7-9ea6-8f703e669064', NULL, 4, '2024-11-09 17:34:01', '2024-11-09 17:34:01', NULL),
	(26, 'b12e37d6-80b9-4450-9bd0-e4664d1dcd12', NULL, 4, '2024-11-09 17:34:13', '2024-11-09 17:34:13', NULL),
	(27, '3ea99cf6-6e67-41c3-9fe4-f6f091e0e14f', 'Ejercicio Físico Planificado', 4, '2024-11-09 23:45:07', '2024-11-09 23:45:31', NULL),
	(28, '844a6e97-7b6c-4f58-8c41-8f6db9670b63', NULL, 4, '2024-11-15 19:57:01', '2024-11-15 19:57:01', NULL),
	(29, '7f548f21-446b-4620-830c-2b2dec20b5b9', NULL, 4, '2024-11-15 19:58:23', '2024-11-15 19:58:23', NULL),
	(30, '0e257d3e-7338-4331-ac70-0846038a95f6', NULL, 4, '2024-11-15 20:01:13', '2024-11-15 20:01:13', NULL),
	(31, 'a9ca9db8-f9a0-4484-92b7-35645c2abbea', NULL, 4, '2024-11-15 22:19:06', '2024-11-15 22:19:06', NULL),
	(32, '9f010ae0-b24b-4338-b5bc-74e7e38c80d6', NULL, 4, '2024-11-15 22:19:15', '2024-11-15 22:19:15', NULL),
	(33, '2ab451b5-cad9-46db-94eb-5a83e750d9e5', NULL, 4, '2024-11-16 16:06:50', '2024-11-16 16:06:50', NULL),
	(34, '2646dae7-9f88-450d-b0b4-165cc96d0db2', NULL, 4, '2024-11-16 17:45:44', '2024-11-16 17:45:44', NULL),
	(35, 'b2fd34c1-2c2a-4580-8aa2-925eb3b99cf1', 'Creating a Creative Title', 4, '2024-11-16 17:47:08', '2024-11-16 17:47:29', NULL),
	(36, '4f6f8881-5fc5-4e4a-88e8-89e3ddadbb1b', NULL, 4, '2024-11-16 17:48:36', '2024-11-16 17:48:36', NULL),
	(37, '3fb286c8-39e1-43bb-970f-4c908e8eceda', NULL, 4, '2024-11-17 05:34:18', '2024-11-17 05:34:18', NULL);

-- Volcando estructura para tabla bd_nutricional_ia.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bd_nutricional_ia.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` bigint unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_user_message` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_conversation_id_foreign` (`conversation_id`),
  CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.messages: ~41 rows (aproximadamente)
REPLACE INTO `messages` (`id`, `conversation_id`, `content`, `is_user_message`, `created_at`, `updated_at`) VALUES
	(1, 20, 'simula ser una experto nutricionista y hasme un plan nutricional\n', 1, '2024-11-09 05:45:09', '2024-11-09 05:45:09'),
	(2, 20, '¡Por supuesto! Antes de empezar, quiero dejar claro que las recomendaciones siguientes son generales y es crucial adaptar cualquier plan de alimentación a las necesidades personales, alergias, condiciones de salud específicas y objetivos de cada persona. Siempre es recomendable consultar a un profesional de la salud o nutricionista certificado para obtener un plan personalizado que sea seguro y efectivo.\n\nPara crear un plan nutricional equilibrado, consideraré las necesidades de una persona promedio con un estilo de vida moderadamente activo. Aquí tienes un ejemplo de cómo podrías organizar tu alimentación a lo largo de una semana:\n\n### Día 1: \n**Desayuno:** Avena con leche de almendras, plátano y un puñado de almendras.  \n**Almuerzo:** Ensalada de quinoa con verduras mixtas, aguacate, tomates cherry, garbanzos y aderezo de limón.  \n**Merienda:** Yogur natural con miel y nueces.  \n**Cena:** Salmón al horno con brócoli al vapor y batatas asadas.\n\n### Día 2:\n**Desayuno:** Batido de espinacas, proteína de vainilla, media banana y leche de coco.  \n**Almuerzo:** Sandwich de pavo en pan integral con lechuga, tomate y mostaza. Acompaña con zanahorias baby.  \n**Merienda:** Manzana con mantequilla de maní.  \n**Cena:** Pollo al curry con arroz integral y una mezcla de verduras al vapor.\n\n### Día 3:\n**Desayuno:** Tostadas integrales con aguacate, tomate y semillas de chía.  \n**Almuerzo:** Ensalada de lentejas con espinacas, nueces, queso feta y aderezo balsámico.  \n**Merienda:** Smoothie de frutos rojos con yogurt griego.  \n**Cena:** Filete de tilapia a la plancha con ensalada de arúgula y pepino.\n\n### Día 4:\n**Desayuno:** Panqueques de avena con frutos rojos y sirope de arce.  \n**Almuerzo:** Sopa de verduras con una porción de pan integral.  \n**Merienda:** Rodajas de pepino con hummus.  \n**Cena:** Estofado de ternera con patatas y zanahorias.\n\n### Día 5:\n**Desayuno:** Bowl de yogurt griego con granola casera y kiwi.  \n**Almuerzo:** Burrito de frijoles negros con arroz integral, salsa de tomate y guacamole.  \n**Merienda:** Frutos secos y una naranja.  \n**Cena:** Pasta integral con boloñesa de pavo y ensalada verde.\n\n### Día 6:\n**Desayuno:** Huevos revueltos con espinacas y champiñones, con una rebanada de pan integral.  \n**Almuerzo:** Ensalada de pollo grillado con verduras de hoja verde, aguacate y semillas de calabaza.  \n**Merienda:** Queso cottage con rodajas de pera.  \n**Cena:** Pescado blanco al horno con puré de calabaza y brócoli asado.\n\n### Día 7:\n**Desayuno:** Smoothie bowl de mango y plátano con coco rallado y semillas de lino.  \n**Almuerzo:** Falafel con tabulé y tzatziki.  \n**Merienda:** Barra de proteínas casera.  \n**Cena:** Pollo asado con patatas y judías verdes.\n\nTen en cuenta ajustar las porciones según tu gasto calórico y requerimientos nutricionales. Asegúrate de beber suficiente agua a lo largo del día y, si puedes, intenta incluir alguna forma de ejercicio regular en tu rutina diaria. ¡Espero que este plan te sea útil y te anime a llevar un estilo de vida más sano y equilibrado!', 0, '2024-11-09 05:45:36', '2024-11-09 05:45:36'),
	(3, 20, 'okey alguna recomendacion mas', 1, '2024-11-09 05:56:34', '2024-11-09 05:56:34'),
	(4, 20, '¡Claro! Aquí tienes algunas recomendaciones adicionales para complementar tu plan nutricional:\n\n1. **Hidratación:** Recuerda beber suficiente agua a lo largo del día, al menos 8 vasos de agua, o más si eres físicamente activo o te encuentras en un clima caluroso.\n\n2. **Snacks saludables:** Añade opciones de snacks saludables a tu dieta, como frutas frescas, vegetales crudos con hummus, yogur natural, frutos secos o barritas de granola caseras.\n\n3. **Controlar el tamaño de las porciones:** Intenta escuchar las señales de hambre y saciedad de tu cuerpo, no te obligues a comer más de lo necesario y evita las porciones excesivas.\n\n4. **Variedad de alimentos:** Procura incluir una amplia variedad de alimentos en tu dieta para asegurarte de obtener todos los nutrientes necesarios. No te limites a los mismos alimentos todo el tiempo.\n\n5. **Evitar alimentos procesados:** Limita la ingesta de alimentos procesados ricos en azúcares añadidos, grasas saturadas y sodio, ya que pueden contribuir a problemas de salud a largo plazo.\n\n6. **Planificación y preparación:** Dedica tiempo a planificar tus comidas y preparar tus alimentos con antelación para evitar recurrir a opciones poco saludables en momentos de prisa.\n\nRecuerda que la clave para una alimentación saludable es la moderación, el equilibrio y la constancia. ¡Espero que estas recomendaciones adicionales te ayuden a mantener un estilo de vida saludable!', 0, '2024-11-09 05:56:41', '2024-11-09 05:56:41'),
	(5, 20, 'peso 75 kilos y mido 170 cm , en base a eso dame una dieta y ejercicio para una semana', 1, '2024-11-09 06:11:57', '2024-11-09 06:11:57'),
	(6, 20, '¡Entendido! Considerando que pesas 75 kg y mides 170 cm, vamos a preparar un plan que pueda ayudarte a mantener un peso saludable, mejorar tu condición física y bienestar general. Supondré un nivel de actividad moderado y que tu objetivo principal es mantener el peso y tonificar.\n\n### Plan Nutricional\n\n**Día 1:**\n- **Desayuno:** Batido de proteína con espinacas, medio plátano, leche de almendras y una cucharada de mantequilla de almendra.\n- **Almuerzo:** Ensalada grande con pechuga de pollo a la plancha, mezcla de hojas verdes, tomate, pepino, un poco de queso feta y aderezo de aceite de oliva.\n- **Merienda:** Yogur griego con una cucharada de miel y semillas de chía.\n- **Cena:** Filete de salmón al horno con camote asado y brócoli al vapor.\n\n**Día 2:**\n- **Desayuno:** Avena cocida con leche de almendras, manzana en trozos y canela.\n- **Almuerzo:** Sopa de lentejas con verduras y una rebanada de pan integral.\n- **Merienda:** Zanahorias con hummus.\n- **Cena:** Pechuga de pollo a la plancha con quinoa y mix de verduras asadas (pimiento, cebolla, zucchini).\n\n**Día 3:**\n- **Desayuno:** 2 huevos revueltos con espinacas y champiñones; 1 rebanada de pan integral tostado.\n- **Almuerzo:** Bowl de arroz integral con falafel, verduras crudas picadas (pepino, tomate, cebolla), y yogur natural como aderezo.\n- **Merienda:** Una manzana y un puñado de almendras.\n- **Cena:** Filete de tilapia al vapor con patatas cocidas y ensalada verde.\n\n**Día 4:**\n- **Desayuno:** Panqueques de avena con frutos rojos frescos y un toque de miel.\n- **Almuerzo:** Ensalada de garbanzos con tomate, pepino, aguacate, cebolla morada, y un chorrito de limón.\n- **Merienda:** Batido de plátano con leche de almendras.\n- **Cena:** Carne de res magra estofada con puré de calabaza y espárragos al vapor.\n\n**Día 5:**\n- **Desayuno:** Yogur griego con frutas del bosque y un pequeño puñado de nueces.\n- **Almuerzo:** Pavo enrollado con verduras y queso en una tortilla integral.\n- **Merienda:** Rodajas de pepino y zanahorias con guacamole.\n- **Cena:** Filetes de trucha al horno con pilaf de arroz integral y ensalada fresca.\n\n**Día 6:**\n- **Desayuno:** Batido de moras, espinacas, proteína en polvo y leche de almendras.\n- **Almuerzo:** Ensalada caprese (mozzarella, tomate, albahaca) con un aderezo de balsámico.\n- **Merienda:** Rodajas de manzana con mantequilla de cacahuete.\n- **Cena:** Pechuga de pollo asada con batatas y verduras a la parrilla.\n\n**Día 7:**\n- **Desayuno:** Huevos pochados con tostada de aguacate.\n- **Almuerzo:** Quinoa con verduras salteadas (pimientos, brócoli, zanahoria) y tofu.\n- **Merienda:** Yogur natural con un poco de granola.\n- **Cena:** Pescado blanco en papillote con limón, acompañado de ensalada de rúcula y tomate cherry.\n\n### Plan de Ejercicio\n\n- **Lunes:**\n  - Cardio: 30 minutos de jogging o bicicleta.\n  - Fuerza: Rutina de cuerpo completo con ejercicios como sentadillas, push-ups y dominadas.\n\n- **Martes:**\n  - Clase de yoga de 1 hora o pilates.\n\n- **Miércoles:**\n  - Cardio: 30 minutos de natación.\n  - Fuerza: rutina de piernas y abdomen.\n\n- **Jueves:**\n  - Descanso o caminata ligera de 30 minutos.\n\n- **Viernes:**\n  - Cardio: 30 minutos de HIIT.\n  - Fuerza: rutina de brazos y espalda.\n\n- **Sábado:**\n  - Actividad recreativa como senderismo, ciclismo o una clase de deporte grupal.\n\n- **Domingo:**\n  - Descanso activo, como estiramiento o una caminata ligera.\n\nRecuerda que es importante ajustar la intensidad y duración según tu condición física y consultar a un profesional antes de comenzar cualquier programa de ejercicios. ¡Espero que encuentres útil este plan!', 0, '2024-11-09 06:12:35', '2024-11-09 06:12:35'),
	(7, 21, 'as un codigo en c++ sobre vectores usando POO', 1, '2024-11-09 06:32:13', '2024-11-09 06:32:13'),
	(8, 21, 'A continuación, te presento un ejemplo de un programa en C++ que utiliza clases para manejar un vector. Este ejemplo se centrará en una clase `Vector` que permite almacenar elementos, acceder a ellos y modificarlos. También será capaz de mostrar todos los elementos del vector.\n\nEl código está diseñado con fines didácticos y tiene la estructura básica para ilustrar cómo implementar operaciones comunes en un vector usando Programación Orientada a Objetos (POO).\n\n```cpp\n#include <iostream>\n#include <vector>\n\nclass MyVector {\nprivate:\n    std::vector<int> data;\n\npublic:\n    MyVector() {};  // Constructor\n\n    // Agrega un elemento al final del vector\n    void push_back(int value) {\n        data.push_back(value);\n    }\n\n    // Esto elimina el último elemento del vector\n    void pop_back() {\n        if (!data.empty()) {\n            data.pop_back();\n        } else {\n            std::cout << "El vector ya está vacío." << std::endl;\n        }\n    }\n\n    // Permite obtener un valor en una posición específica\n    int get(int index) {\n        if (index >= 0 && index < data.size()) {\n            return data[index];\n        } else {\n            std::cout << "Índice fuera de rango." << std::endl;\n            return -1; // Valor de error\n        }\n    }\n\n    // Modifica el valor en una posición específica\n    void set(int index, int value) {\n        if (index >= 0 && index < data.size()) {\n            data[index] = value;\n        } else {\n            std::cout << "Índice fuera de rango." << std::endl;\n        }\n    }\n\n    // Muestra todos los elementos del vector\n    void display() {\n        std::cout << "Elementos del vector:" << std::endl;\n        for (int i : data) {\n            std::cout << i << " ";\n        }\n        std::cout << std::endl;\n    }\n\n    // Retorna el tamaño del vector\n    int size() {\n        return data.size();\n    }\n};\n\nint main() {\n    MyVector vec;\n\n    vec.push_back(10);\n    vec.push_back(20);\n    vec.push_back(30);\n\n    std::cout << "Después de insertar elementos: " << std::endl;\n    vec.display();\n\n    std::cout << "El elemento en la posición 1 es: " << vec.get(1) << std::endl;\n\n    vec.set(1, 100);\n    std::cout << "Después de modificar el elemento en la posición 1: " << std::endl;\n    vec.display();\n\n    vec.pop_back();\n    vec.pop_back();\n    vec.pop_back();\n    vec.pop_back();  // Intenta eliminar más allá del tamaño\n\n    std::cout << "Después de eliminar elementos: " << std::endl;\n    vec.display();\n\n    return 0;\n}\n```\n\nEste programa incluye lo siguiente:\n1. Una clase `MyVector` que encapsula un vector de `int`.\n2. Métodos para agregar (`push_back`) y eliminar (`pop_back`) elementos al vector.\n3. Métodos para acceder (`get`) y modificar (`set`) elementos del vector.\n4. Un método para mostrar todos los elementos del vector (`display`).\n5. Un sencillo `main` que prueba el uso de esta clase.\n\nEste código es solo un ejemplo básico y puede ser extendido con más funcionalidades si es necesario. Por ejemplo, se podría gestionar tipos genéricos con plantillas, implementar iteradores, gestionar excepciones en lugar de retornar valores de error, etc.', 0, '2024-11-09 06:32:41', '2024-11-09 06:32:41'),
	(9, 22, 'Dame un plan de dieta ', 1, '2024-11-09 08:10:33', '2024-11-09 08:10:33'),
	(10, 22, 'para bajar de peso:\n\n- Desayuno: \n   - 1 taza de yogur natural bajo en grasa con frutas frescas\n   - 1 rebanada de pan integral con aguacate y tomate\n   - 1 taza de té verde o café sin azúcar\n\n- Media mañana:\n   - 1 puñado de nueces o almendras\n\n- Almuerzo:\n   - Ensalada de espinacas con pollo a la parrilla, tomate, pepino y vinagreta de limón\n   - 1 porción de quinoa o arroz integral\n\n- Merienda:\n   - 1 manzana o pera\n   - 1 vaso de agua\n\n- Cena:\n   - Filete de pescado al horno con verduras al vapor\n   - 1 batata asada con canela\n   - Infusión de hierbas\n\nRecuerda beber al menos 2 litros de agua al día, realizar ejercicio regularmente y limitar el consumo de alimentos procesados y altos en grasas saturadas. Consulta a un nutricionista o médico antes de comenzar cualquier plan de dieta para asegurarte de que sea seguro y adecuado para tus necesidades individuales.', 0, '2024-11-09 08:10:41', '2024-11-09 08:10:41'),
	(11, 22, 'que mas seria', 1, '2024-11-09 15:51:53', '2024-11-09 15:51:53'),
	(12, 22, 'Además de seguir el plan de dieta mencionado anteriormente, aquí tienes algunas recomendaciones adicionales para bajar de peso de manera efectiva:\n\n- Controla las porciones: Trata de comer porciones más pequeñas y escucha a tu cuerpo para saber cuándo estás realmente satisfecho.\n\n- Evita los alimentos procesados y azúcares refinados: Opta por alimentos frescos, naturales y ricos en fibra, como frutas, verduras, granos enteros y proteínas magras.\n\n- Incluye fuentes de proteína en cada comida: La proteína ayuda a mantenerte lleno por más tiempo, acelerar tu metabolismo y mantener la masa muscular durante la pérdida de peso.\n\n- Planifica tus comidas y snacks: Esto te ayudará a mantener el control de lo que estás comiendo y a evitar la tentación de recurrir a opciones poco saludables.\n\n- Realiza actividad física regularmente: Combina tu plan de dieta con ejercicio físico, como caminar, correr, hacer yoga, nadar o cualquier otra actividad que disfrutes.\n\nSi sigues estos consejos y mantienes un estilo de vida saludable, podrás lograr tus objetivos de pérdida de peso de manera segura y sostenible. No olvides que la clave está en la constancia y la perseverancia. ¡Buena suerte!', 0, '2024-11-09 15:51:58', '2024-11-09 15:51:58'),
	(13, 22, 'algo mas que puedo hacer para mejorar mi salud', 1, '2024-11-09 16:01:39', '2024-11-09 16:01:39'),
	(14, 22, 'a', 1, '2024-11-09 16:02:50', '2024-11-09 16:02:50'),
	(15, 22, 's', 1, '2024-11-09 16:07:40', '2024-11-09 16:07:40'),
	(16, 22, 'ds', 1, '2024-11-09 16:07:46', '2024-11-09 16:07:46'),
	(17, 22, 'elvis', 1, '2024-11-09 16:09:10', '2024-11-09 16:09:10'),
	(18, 22, 'elvis', 1, '2024-11-09 16:09:44', '2024-11-09 16:09:44'),
	(19, 22, '¿Cómo puedo ayudarte con respecto a Elvis Presley?', 0, '2024-11-09 16:09:46', '2024-11-09 16:09:46'),
	(20, 22, 'cuales son su musica mas famossa\n', 1, '2024-11-09 16:10:14', '2024-11-09 16:10:14'),
	(21, 22, 'Algunas de las canciones más famosas de Elvis Presley son:\n\n- "Can\'t Help Falling in Love"\n- "Jailhouse Rock"\n- "Love Me Tender"\n- "Suspicious Minds"\n- "Hound Dog"\n- "Heartbreak Hotel"\n- "Blue Suede Shoes"\n- "Always on My Mind"\n- "A Little Less Conversation"\n- "Burning Love"\n\nEstas son solo algunas de las canciones icónicas de Elvis Presley que han dejado una huella imborrable en la historia de la música. ¡Espero que disfrutes escuchando su música!', 0, '2024-11-09 16:10:17', '2024-11-09 16:10:17'),
	(22, 22, 'wow', 1, '2024-11-09 16:15:56', '2024-11-09 16:15:56'),
	(23, 22, 'se ve genial', 1, '2024-11-09 16:20:20', '2024-11-09 16:20:20'),
	(24, 22, 'hola', 1, '2024-11-09 16:21:04', '2024-11-09 16:21:04'),
	(25, 22, 'rtyu', 1, '2024-11-09 17:16:18', '2024-11-09 17:16:18'),
	(26, 22, 'sal con manga es rico', 1, '2024-11-09 17:17:12', '2024-11-09 17:17:12'),
	(27, 22, 'dime todo sobre redes neuronales', 1, '2024-11-09 17:21:19', '2024-11-09 17:21:19'),
	(28, 22, 'dime todo sobre redes neuronales', 1, '2024-11-09 17:22:01', '2024-11-09 17:22:01'),
	(29, 22, 'Las redes neuronales son un conjunto de algoritmos y técnicas de aprendizaje automático inspiradas en la estructura y funcionamiento del cerebro humano. Se utilizan en diversos campos, como reconocimiento de patrones, procesamiento de lenguaje natural, visión por computadora, análisis de datos, entre otros. Aquí hay algunos puntos clave sobre las redes neuronales:\n\n1. **Estructura de red**: Una red neuronal está compuesta por capas de neuronas interconectadas. Estas capas pueden ser de tres tipos: capa de entrada (donde se introducen los datos), capas ocultas (donde se procesan los datos) y capa de salida (donde se proporciona la respuesta).\n\n2. **Neuronas**: Las neuronas artificiales son unidades básicas de procesamiento en una red neuronal. Cada neurona recibe entradas, realiza cálculos matemáticos y produce una salida. Estas salidas se utilizan como entradas para las neuronas de la siguiente capa.\n\n3. **Conexiones**: Las conexiones entre neuronas tienen pesos asociados que se ajustan durante el entrenamiento de la red. Estos pesos determinan la importancia de cada entrada en el cálculo realizado por la neurona.\n\n4. **Aprendizaje**: Las redes neuronales aprenden a partir de un proceso iterativo de entrenamiento. Durante el entrenamiento, se ajustan los pesos de las conexiones para minimizar una función de pérdida que evalúa la diferencia entre las salidas predichas y las salidas reales.\n\n5. **Tipos de redes neuronales**: Existen diversos tipos de redes neuronales, como redes neuronales feedforward, redes neuronales convolucionales (CNN), redes neuronales recurrentes (RNN), entre otras, cada una con aplicaciones específicas.\n\n6. **Aplicaciones**: Las redes neuronales se utilizan en una amplia gama de aplicaciones, como reconocimiento de voz, reconocimiento facial, diagnóstico médico, traducción de idiomas, vehículos autónomos, entre otras.\n\nEn resumen, las redes neuronales son una poderosa herramienta de aprendizaje automático que ha revolucionado muchas áreas de la tecnología y la ciencia. Su capacidad para aprender patrones complejos a partir de datos los hace extremadamente útiles en la actualidad.', 0, '2024-11-09 17:22:09', '2024-11-09 17:22:09'),
	(30, 27, 'has un plan de ejercicio\n', 1, '2024-11-09 23:45:27', '2024-11-09 23:45:27'),
	(31, 27, '', 1, '2024-11-09 23:45:28', '2024-11-09 23:45:28'),
	(32, 27, '¡Claro! Puedo ayudarte a crear un plan de ejercicio básico. Sin embargo, es importante considerar tu nivel de condición física actual, tus objetivos y cualquier condición médica que puedas tener antes de comenzar un nuevo programa de ejercicios. Aquí tienes un plan general que incluye una combinación de entrenamiento cardiovascular, de fuerza y flexibilidad. Asegúrate de consultar con un profesional de la salud antes de empezar cualquier nuevo régimen de entrenamiento.\n\n### Plan de Ejercicio Semanal Básico\n\n#### Día 1: Cardio\n- **Calentamiento**: 5-10 minutos caminando\n- **Actividad Principal**: Correr/jogging durante 20-30 minutos\n- **Enfriamiento**: 5 minutos caminando\n- **Estiramiento**: 5 minutos\n\n#### Día 2: Fuerza (Parte superior del cuerpo)\n- **Calentamiento**: 5-10 minutos de calistenia ligera (saltos, rodillas altas)\n- **Ejercicios**:\n  - Push-ups: 3 series de 10-15 repeticiones\n  - Plank: 3 de 30 segundos\n  - Ejercicios con mancuernas (si están disponibles): curls de bíceps, triceps dips, press de hombros - 3 series de 10-15 repeticiones cada uno\n- **Enfriamiento y Estiramiento**: 10 minutos\n\n#### Día 3: Descanso o actividad ligera\n- Actividades como el yoga suave o una caminata larga\n\n#### Día 4: Cardio\n- **Calentamiento**: 5-10 minutos caminando\n- **Actividad Principal**: Ciclismo/bicicleta estática durante 20-30 minutos\n- **Enfriamiento**: 5 minutos caminando\n- **Estiramiento**: 5 minutos\n\n#### Día 5: Fuerza (Parte inferior del cuerpo)\n- **Calentamiento**: 5-10 minutos de calistenia ligera\n- **Ejercicios**:\n  - Sentadillas: 3 series de 10-15 repeticiones\n  - Estocadas: 3 series de 10 repeticiones para cada pierna\n  - Elevaciones de pantorrillas: 3 series de 15 repeticiones\n- **Enfriamiento y Estiramiento**: 10 minutos\n\n#### Día 6: Flexibilidad o Actividad Recreativa\n- **Yoga**, Pilates o una actividad al aire libre que disfrutes (natación, senderismo, etc.)\n\n#### Día 7: Descanso\n- Un día completo de descanso, enfocado en la recuperación\n\n### Consejos Generales\n- **Hidratación**: Bebe agua antes, durante y después del ejercicio.\n- **Nutrición**: Sigue una dieta equilibrada que apoye tus objetivos de ejercicio.\n- **Progresión**: Aumenta gradualmente la intensidad y la duración de tus ejercicios.\n- **Escucha a tu cuerpo**: Si sientes dolor o incomodidad excesiva, reduce la intensidad o descansa.\n\nEste plan es solo un ejemplo y puede ser ajustado según tus necesidades y preferencias personales. Disfruta de tu viaje hacia un estilo de vida más activo y saludable.', 0, '2024-11-09 23:45:51', '2024-11-09 23:45:51'),
	(33, 27, 'Es genial que estés interesado en comenzar un plan de ejercicio. Aquí tienes una idea de cómo podrías estructurar tu semana para incluir una buena mezcla de cardio, fuerza y flexibilidad. Esto te ayudará a obtener un equilibrio de todos los componentes principales de la aptitud física. Asegúrate de adaptar la intensidad y la duración de los ejercicios según tu nivel de condición física.\n\n### Plan de Ejercicio Semanal\n\n#### Día 1: Cardio\n- **Calentamiento**: 10 minutos de caminata rápida o trote ligero.\n- **Actividad Principal**: 30 minutos de carrera a una intensidad moderada.\n- **Enfriamiento**: 5 minutos de caminata lenta.\n- **Estiramiento**: 10 minutos de estiramientos básicos.\n\n#### Día 2: Fuerza (Parte Superior del Cuerpo)\n- **Calentamiento**: 5-10 minutos de saltos, jacks, o cuerda.\n- **Ejercicio Principal**:\n  - 3 series de 12 repeticiones de flexiones de pecho.\n  - 3 series de 12 repeticiones de elevaciones laterales con mancuernas.\n  - 3 series de 12 repeticiones de remo con banda elástica o mancuernas.\n- **Enfriamiento y Estiramiento**: 5-10 minutos de estiramiento de brazos y hombros.\n\n#### Día 3: Cardio Intervalo\n- **Calentamiento**: 10 minutos de trote suave.\n- **Actividad Principal**: Intervalos de 1 minuto de sprints y 2 minutos de caminata (repetir 5-10 veces).\n- **Enfriamiento**: 5 minutos de caminata.\n- **Estiramiento**: 5 minutos.\n\n#### Día 4: Fuerza (Parte Inferior del Cuerpo)\n- **Calentamiento**: 5-10 minutos de ejercicios de movilidad.\n- **Ejercicio Principal**:\n  - 3 series de 15 repeticiones de sentadillas.\n  - 3 series de 12 repeticiones de lunges (estocadas) por pierna.\n  - 3 series de 15 elevaciones de talones.\n- **Enfriamiento y Estiramiento**: 5-10 minutos de estiramiento de piernas.\n\n#### Día 5: Día Activo de Recuperación\n- **Actividad**: 30-60 minutos de una actividad de baja intensidad como yoga, pilates o una caminata suave.\n\n#### Día 6: Circuito Mixto\n- **Calentamiento**: 5-10 minutos de calistenia ligera.\n- **Circuito**: Rotar entre 3 minutos de cardio (saltar, correr en el lugar), 2 minutos de ejercicios de fuerza (flexiones, abdominales, sentadillas) y 3 minutos de descanso. Repetir 3 veces.\n- **Enfriamiento y Estiramiento**: 10 minutos total.\n\n#### Día 7: Descanso Total\n- **Actividad**: Nada estructurado, enfoque total en la recuperación.\n\n### Notas Adicionales:\n- Asegúrate de hidratarte adecuadamente antes, durante y después de tus entrenamientos.\n- Escucha a tu cuerpo y ajusta la intensidad de los entrenamientos según sea necesario.\n- Considera incluir una dieta equilibrada que apoye tus objetivos de fitness.\n\nEste plan de ejercicio es solo una guía y puede ser personalizado para ajustarse mejor a tus objetivos específicos y nivel de condición física actual. ¡Buena suerte en tu viaje de fitness!', 0, '2024-11-09 23:46:18', '2024-11-09 23:46:18'),
	(34, 27, 'as un plan de ejercicio y devuelve la respuesta en formato json\n', 1, '2024-11-09 23:46:19', '2024-11-09 23:46:19'),
	(35, 27, 'Aquí tienes un plan de ejercicio estructurado en formato JSON, que te permitirá entender cómo organizar tu rutina semanal de ejercicios con distintas actividades. Puedes implementar este plan según tus necesidades y ajustarlo a medida que progresas o según las recomendaciones de un profesional.\n\n```json\n{\n  "PlanDeEjercicio": [\n    {\n      "Dia": "1",\n      "Tipo": "Cardio",\n      "Actividades": [\n        {"Calentamiento": "10 minutos de caminata rápida o trote ligero"},\n        {"Principal": "30 minutos de carrera a intensidad moderada"},\n        {"Enfriamiento": "5 minutos de caminata lenta"},\n        {"Estiramiento": "10 minutos estiramientos básicos"}\n      ]\n    },\n    {\n      "Dia": "2",\n      "Tipo": "Fuerza (Parte Superior del Cuerpo)",\n      "Actividades": [\n        {"Calentamiento": "5-10 minutos de saltos, jacks o cuerda"},\n        {"Principal": [\n          {"Ejercicio": "Flexiones de pecho", "Series": "3", "Repeticiones": "12"},\n          {"Ejercicio": "Elevaciones laterales con mancuernas", "Series": "3", "Repeticiones": "12"},\n          {"Ejercicio": "Remo con banda elástica o mancuernas", "Series": "3", "Repeticiones": "12"}\n        ]},\n        {"Enfriamiento y Estiramiento": "5-10 minutos estiramiento de brazos y hombros"}\n      ]\n    },\n    {\n      "Dia": "3",\n      "Tipo": "Cardio Intervalo",\n      "Actividades": [\n        {"Calentamiento": "10 minutos de trote suave"},\n        {"Principal": "Intervalos de 1 minuto de sprints y 2 minutos de caminata (repetir 5-10 veces)"},\n        {"Enfriamiento": "5 minutos de caminata"},\n        {"Estiramiento": "5 minutos"}\n      ]\n    },\n    {\n      "Dia": "4",\n      "Tipo": "Fuerza (Parte Inferior del Cuerpo)",\n      "Actividades": [\n        {"Calentamiento": "5-10 minutos de ejercicios de movilidad"},\n        {"Principal": [\n          {"Ejercicio": "Sentadillas", "Series": "3", "Repeticiones": "15"},\n          {"Ejercicio": "Lunges (estocadas) por pierna", "Series": "3", "Repeticiones": "12"},\n          {"Ejercicio": "Elevaciones de talones", "Series": "3", "Repeticiones": "15"}\n        ]},\n        {"Enfriamiento y Estiramiento": "5-10 minutos de estiramiento de piernas"}\n      ]\n    },\n    {\n      "Dia": "5",\n      "Tipo": "Día Activo de Recuperación",\n      "Actividades": [\n        {"Actividad": "30-60 minutos de una actividad de baja intensidad como yoga, pilates o una caminata suave"}\n      ]\n    },\n    {\n      "Dia": "6",\n      "Tipo": "Circuito Mixto",\n      "Actividades": [\n        {"Calentamiento": "5-10 minutos de calistenia ligera"},\n        {"Circuito": "Rotar entre 3 minutos de cardio (saltar, correr en el lugar), 2 minutos de ejercicios de fuerza (flexiones, abdominales, sentadillas) y 3 minutos de descanso. Repetir 3 veces"},\n        {"Enfriamiento y Estiramiento": "10 minutos total"}\n      ]\n    },\n    {\n      "Dia": "7",\n      "Tipo": "Descanso Total",\n      "Actividades": [\n        {"Actividad": "Nada estructurado, enfoque total en la recuperación"}\n      ]\n    }\n  ]\n}\n```\n\nEste formato JSON estructura tus actividades diarias en un orden claro y fácil de seguir, facilitando la comprensión del tipo de ejercicio y los detalles de cada actividad. Puedes adaptar este plan según tus metas específicas y consultar a un profesional para asegurar que se ajuste a tus necesidades de salud.', 0, '2024-11-09 23:46:42', '2024-11-09 23:46:42'),
	(36, 27, 't1\nas un plan de ejercicio y devuelve la respuesta en formato json', 1, '2024-11-09 23:46:43', '2024-11-09 23:46:43'),
	(37, 27, 'A continuación, te proporciono un plan de ejercicio presentado en formato JSON, ideal para alguien que busca una estructura semanal con variedad en los tipos de ejercicios realizados. Este plan incluye días de cardio, fuerza, recuperación activa y descanso.\n\n```json\n{\n  "PlanDeEjercicio": {\n    "Semana": [\n      {\n        "Dia": "1",\n        "Actividad": "Cardio",\n        "Detalles": {\n          "Calentamiento": "10 minutos trotando suave",\n          "Principal": "20 minutos corriendo a ritmo moderado",\n          "Enfriamiento": "5 minutos caminata ligera",\n          "Estiramiento": "5 minutos"\n        }\n      },\n      {\n        "Dia": "2",\n        "Actividad": "Fuerza (Parte Superior del Cuerpo)",\n        "Detalles": {\n          "Calentamiento": "5 minutos saltos ligeros",\n          "Ejercicios": [\n            {"Nombre": "Flexiones", "Series": 3, "Repeticiones": 12},\n            {"Nombre": "Press de Banca con Mancuernas", "Series": 3, "Repeticiones": 10},\n            {"Nombre": "Remo con Mancuerna", "Series": 3, "Repeticiones": 10}\n          ],\n          "Enfriamiento": "5 minutos",\n          "Estiramiento": "5 minutos"\n        }\n      },\n      {\n        "Dia": "3",\n        "Actividad": "Cardio Ligero",\n        "Detalles": {\n          "Actividad": "30 minutos de bicicleta estática a baja intensidad"\n        }\n      },\n      {\n        "Dia": "4",\n        "Actividad": "Fuerza (Parte Inferior del Cuerpo)",\n        "Detalles": {\n          "Calentamiento": "7 minutos de estiramientos dinámicos",\n          "Ejercicios": [\n            {"Nombre": "Sentadillas", "Series": 3, "Repeticiones": 15},\n            {"Nombre": "Lunges", "Series": 3, "Repeticiones": 12 por pierna},\n            {"Nombre": "Peso Muerto", "Series": 3, "Repeticiones": 10}\n          ],\n          "Enfriamiento": "5 minutos",\n          "Estiramiento": "5 minutos"\n        }\n      },\n      {\n        "Dia": "5",\n        "Actividad": "Recuperación Activa",\n        "Detalles": {\n          "Actividad": "Yoga o Pilates durante 30 minutos"\n        }\n      },\n      {\n        "Dia": "6",\n        "Actividad": "Mixto: Cardio y Fuerza",\n        "Detalles": {\n          "Calentamiento": "5 minutos caminando",\n          "Circuito": [\n            {"Actividad": "Correr", "Duración": "2 min"},\n            {"Actividad": "Flexiones", "Repeticiones": 15},\n            {"Actividad": "Saltar la cuerda", "Duración": "1 min"},\n            {"Actividad": "Abdominales", "Repeticiones": 20}\n          ],\n          "Repeticiones del circuito": 3,\n          "Enfriamiento": "5 minutos",\n          "Estiramiento": "5 minutos"\n        }\n      },\n      {\n        "Dia": "7",\n        "Actividad": "Descanso",\n        "Detalles": {\n          "Nota": "Evitar ejercicio estructurado, enfocarse en la recuperación"\n        }\n      }\n    ]\n  }\n}\n```\n\nEste plan de ejercicio es ideal para mantener un equilibrio entre distintos tipos de entrenamiento a lo largo de la semana, cada día enfocado en un aspecto diferente de la condición física, desde el cardio hasta la fuerza y la recuperación. Es conveniente adaptar la intensidad y duración según tus necesidades específicas y consultar a un profesional de la salud o entrenador físico antes de comenzar cualquier nuevo régimen de ejercicios.', 0, '2024-11-09 23:47:08', '2024-11-09 23:47:08'),
	(38, 35, 'rwerwer', 1, '2024-11-16 17:47:25', '2024-11-16 17:47:25'),
	(39, 35, 'Hello! How can I assist you today?', 0, '2024-11-16 17:47:30', '2024-11-16 17:47:30'),
	(40, 35, 'ah un plan de entrenamiento vasado en mis peso de 70kilos y mi altura de 1,69 centimetros\n', 1, '2024-11-16 17:48:15', '2024-11-16 17:48:15'),
	(41, 35, 'Claro, aquí te dejo un ejemplo de un plan de entrenamiento básico basado en tu peso y altura:\n\nDía 1: Entrenamiento de fuerza\n- Sentadillas: 3 series de 12 repeticiones\n- Prensa de piernas: 3 series de 12 repeticiones\n- Press de banca: 3 series de 12 repeticiones\n- Dominadas: 3 series de 10 repeticiones\n\nDía 2: Descanso activo (caminar, estiramientos suaves)\n\nDía 3: Entrenamiento de circuito\nRealiza 3 rondas de:\n- 10 burpees\n- 15 saltos al cajón\n- 20 flexiones\n- 20 abdominales\n\nDía 4: Descanso activo (caminar, estiramientos suaves)\n\nDía 5: Entrenamiento de resistencia\n- Correr durante 30 minutos a un ritmo moderado\n\nDía 6 y 7: Descanso o actividades de baja intensidad (caminata, yoga, etc.)\n\nRecuerda ajustar la intensidad y el volumen del entrenamiento según tu condición física actual y progresar gradualmente. Además, es importante consultar a un profesional de la salud o un entrenador personal antes de comenzar un nuevo plan de entrenamiento. ¡Buena suerte!', 0, '2024-11-16 17:48:19', '2024-11-16 17:48:19');

-- Volcando estructura para tabla bd_nutricional_ia.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.migrations: ~9 rows (aproximadamente)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2024_10_20_183839_create_permission_tables', 1),
	(7, '2024_11_08_160726_create_conversations_table', 2),
	(8, '2024_11_08_201422_create_messages_table', 3),
	(9, '2024_11_16_114355_create_questions_table', 4);

-- Volcando estructura para tabla bd_nutricional_ia.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.model_has_permissions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bd_nutricional_ia.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.model_has_roles: ~1 rows (aproximadamente)
REPLACE INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 4);

-- Volcando estructura para tabla bd_nutricional_ia.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.password_resets: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bd_nutricional_ia.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bd_nutricional_ia.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.permissions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bd_nutricional_ia.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.personal_access_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bd_nutricional_ia.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.questions: ~30 rows (aproximadamente)
REPLACE INTO `questions` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
	(1, '¿Prefieres comidas altas en proteínas?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(2, '¿Cuántas veces por semana haces ejercicio?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(3, '¿Te sientes con energía al levantarte?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(4, '¿Prefieres seguir una rutina de gimnasio o actividad al aire libre?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(5, '¿Tienes restricciones dietéticas específicas?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(6, '¿Cuánto tiempo puedes dedicar al ejercicio diariamente?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(7, '¿Qué tan importante es para ti perder peso?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(8, '¿Te interesa aumentar tu masa muscular?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(9, '¿Tienes acceso a equipos de ejercicio?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(10, '¿Prefieres comidas preparadas en casa o comida rápida?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(11, '¿Qué nivel de intensidad te gusta en tus actividades físicas?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(12, '¿Tienes algún problema de salud que limite tus actividades?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(13, '¿Cuánto tiempo dedicas actualmente a planificar tus comidas?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(14, '¿Te gusta realizar actividades físicas en grupo?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(15, '¿Tienes interés en probar nuevas recetas saludables?', '2024-11-16 16:03:05', '2024-11-16 16:03:05'),
	(16, '¿Prefieres comidas altas en proteínas?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(17, '¿Cuántas veces por semana haces ejercicio?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(18, '¿Te sientes con energía al levantarte?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(19, '¿Prefieres seguir una rutina de gimnasio o actividad al aire libre?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(20, '¿Tienes restricciones dietéticas específicas?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(21, '¿Cuánto tiempo puedes dedicar al ejercicio diariamente?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(22, '¿Qué tan importante es para ti perder peso?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(23, '¿Te interesa aumentar tu masa muscular?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(24, '¿Tienes acceso a equipos de ejercicio?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(25, '¿Prefieres comidas preparadas en casa o comida rápida?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(26, '¿Qué nivel de intensidad te gusta en tus actividades físicas?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(27, '¿Tienes algún problema de salud que limite tus actividades?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(28, '¿Cuánto tiempo dedicas actualmente a planificar tus comidas?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(29, '¿Te gusta realizar actividades físicas en grupo?', '2024-11-16 16:04:11', '2024-11-16 16:04:11'),
	(30, '¿Tienes interés en probar nuevas recetas saludables?', '2024-11-16 16:04:11', '2024-11-16 16:04:11');

-- Volcando estructura para tabla bd_nutricional_ia.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.roles: ~2 rows (aproximadamente)
REPLACE INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'administrator', 'web', '2024-11-07 13:52:26', NULL),
	(2, 'patient', 'web', '2024-11-07 13:52:57', NULL);

-- Volcando estructura para tabla bd_nutricional_ia.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.role_has_permissions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bd_nutricional_ia.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_nutricional_ia.users: ~1 rows (aproximadamente)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(4, 'test1', 'test1@finor.bo', NULL, '$2y$10$b8lgfr3LE34Uyw1vuxlqkOBW2oX.ncEpbFnogHlbVIDwVsJwKPJze', NULL, '2024-11-07 17:57:02', '2024-11-07 17:57:02');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
