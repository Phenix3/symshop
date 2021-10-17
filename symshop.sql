-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 08 oct. 2021 à 18:32
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `symshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE `address` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `country_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `is_professionnal` tinyint(1) NOT NULL,
  `civility` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addressbis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bp` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `address`
--

INSERT INTO `address` (`id`, `country_id`, `user_id`, `is_professionnal`, `civility`, `name`, `first_name`, `company`, `address`, `addressbis`, `bp`, `postal`, `city`, `phone`, `created_at`, `updated_at`) VALUES
('0aeb21a1-dea0-4afc-8716-152653963bab', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', NULL, 0, 'Mme.', 'Felix Moore DVM', 'Cleve', 'McDermott-Schuster', '9001 Etha Cove Suite 063\nWest Niko, SC 49757-3856', NULL, '486 Grant Knolls Suite 813', '25589', 'Bernhardbury', '(531) 370-4235', '2021-10-08 18:05:06', NULL),
('255e00d6-3dd0-4d45-9f7b-4c5bbe9611cf', 'f08ece32-cf5e-4715-b7ef-495864443d47', NULL, 1, 'M.', 'Deonte Harber', 'Olen', 'Beer-Schowalter', '39905 Stan Heights\nSouth Kaden, HI 13766-8053', NULL, '14136 Rosenbaum Highway', '92177', 'Bradtkestad', '628.850.6622', '2021-10-08 18:05:06', NULL),
('28aacac9-8f92-4d34-8a23-e6f25d3b689c', '5c67510a-cc8c-488d-93b5-412ea8ab1597', NULL, 1, 'Mme.', 'Giuseppe Ebert DVM', 'Haleigh', 'Hoppe and Sons', '77628 McClure Hollow\nSouth Sincereside, NC 76115-7005', NULL, '96794 Rau Course', '69075-5314', 'Port Chris', '+18724436544', '2021-10-08 18:05:06', NULL),
('28c72a93-ebb4-4075-9d93-c6fb432e05ae', '64e928be-1bcb-4aa5-b806-9438dc78f414', NULL, 0, 'M.', 'Miss Kyla Russel DVM', 'Amina', 'Schroeder-Heaney', '761 Yadira Camp Apt. 281\nConnellyhaven, WA 34223-0331', NULL, '51609 Flavio Mountain', '14943-8449', 'East Bethel', '1-616-237-9964', '2021-10-08 18:05:06', NULL),
('2d0d388c-2383-4669-9ef6-16357051d980', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', NULL, 0, 'Mme.', 'Mikayla Wilkinson', 'Kenya', 'Douglas-Bogan', '682 Naomi Trafficway\nEast Meredith, MD 83519-3609', NULL, '60919 Bernhard Shoals Apt. 947', '74251', 'East Neal', '847-515-2067', '2021-10-08 18:05:06', NULL),
('2e335e75-742f-4d19-86c6-080d993ff2ed', 'f08ece32-cf5e-4715-b7ef-495864443d47', NULL, 1, 'Mme.', 'Nona Cormier', 'Adell', 'Mills-Stamm', '714 Littel Light\nNorth Willy, NV 56952', NULL, '327 Francesca Inlet Suite 040', '29860', 'Elyssastad', '+1-478-552-0762', '2021-10-08 18:05:06', NULL),
('30499d80-b1bb-4185-b961-f1135006d4e8', '5aa6ddb7-ad5a-46a8-a012-d09f6ce1b9a9', NULL, 0, 'Mme.', 'Miss Annette Pouros DVM', 'Magdalen', 'Watsica-Bahringer', '78416 Fernando Ville\nNorth Wandaton, NV 67409-5118', NULL, '4102 Jimmie Overpass', '53402-4987', 'Terryborough', '+1.213.579.7776', '2021-10-08 18:05:06', NULL),
('3bb76d58-e25e-4acc-8603-f967e0ca2d01', 'f075519b-f4f8-4ab5-9d7b-e6d188f6cc37', NULL, 0, 'Mme.', 'Audra Swaniawski Sr.', 'Malcolm', 'Kilback and Sons', '967 Kuphal Manor\nWehnerton, NE 41496-6476', NULL, '536 Merl Dam', '33096-4299', 'Francescobury', '1-878-818-7010', '2021-10-08 18:05:06', NULL),
('3df5b311-7913-4ca7-abdd-c32402c63005', '64e928be-1bcb-4aa5-b806-9438dc78f414', NULL, 0, 'M.', 'Chaya Price', 'Sam', 'Osinski, Ritchie and Osinski', '3382 Gwen Lodge Apt. 874\nSouth Cletus, AL 32451', NULL, '627 Heaney Fields', '96377-0063', 'Port Dariusborough', '(425) 658-2023', '2021-10-08 18:05:06', NULL),
('475719cc-86a0-4f51-a393-f4348f308e8f', 'f075519b-f4f8-4ab5-9d7b-e6d188f6cc37', NULL, 0, 'Mme.', 'Blaze Fisher', 'Tremayne', 'Gerlach-Turcotte', '693 Ledner Street Suite 623\nTianachester, ID 23136-3265', NULL, '11654 Hector Springs Apt. 388', '04842-0973', 'Port Isabell', '+1-205-441-3911', '2021-10-08 18:05:06', NULL),
('47c6b433-7457-40fb-a2c4-b151ebbb9410', '5c67510a-cc8c-488d-93b5-412ea8ab1597', NULL, 1, 'M.', 'Alda Ruecker', 'Peggie', 'Emmerich, Schmidt and Cruickshank', '2579 Kip Summit\nJarrodstad, AK 39563-4972', NULL, '5036 Monahan Path Apt. 310', '04430', 'Langborough', '(347) 502-3959', '2021-10-08 18:05:06', NULL),
('4827060a-bd47-46d0-a26a-1d82d7a6d026', '5aa6ddb7-ad5a-46a8-a012-d09f6ce1b9a9', NULL, 0, 'M.', 'Mrs. Prudence Kreiger', 'Haylee', 'Hackett-Welch', '53052 Stokes Terrace Suite 322\nDietrichfurt, WA 24455-0586', NULL, '911 Hartmann Fort Apt. 590', '99107-6252', 'North Imani', '986.694.9169', '2021-10-08 18:05:06', NULL),
('49650b02-7d01-4349-8c2b-6451d07225cc', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', NULL, 0, 'Mme.', 'Hollie Nienow', 'Alf', 'Pollich Inc', '7958 Mohammad Squares\nWest Fleta, AR 84201-1080', NULL, '9113 Hailey Radial', '15762-0769', 'South Ardellashire', '(678) 896-1147', '2021-10-08 18:05:06', NULL),
('4af950f5-dc64-4263-b618-90bb6c02a6cd', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', NULL, 1, 'M.', 'Dr. Darrin Kohler III', 'Rollin', 'Lind, Franecki and Veum', '858 Feest Skyway Apt. 495\nLake Dantetown, WV 42743', NULL, '103 Will Ridges Suite 475', '75318-1732', 'South Kim', '+1-805-430-7579', '2021-10-08 18:05:06', NULL),
('4f1b53f4-f38f-483c-a5f9-aaac3057f7d9', '374e89ab-eaad-498c-ad02-dd40fb55b5aa', NULL, 0, 'M.', 'Dr. Leif Bode MD', 'Ryder', 'Sipes-Gutkowski', '9241 Al Mall Apt. 949\nNew Clotildemouth, ID 73771-6265', NULL, '70290 Jenkins Cliff Suite 146', '36317-8635', 'New Koby', '445-995-0428', '2021-10-08 18:05:06', NULL),
('526c70d3-806f-4231-9ec9-a746214d1f45', '05971113-b6a7-4cbc-a90d-46c82cb1d3b1', NULL, 0, 'Mme.', 'Miss Romaine Boyer DDS', 'Patience', 'Beatty Group', '80135 Stroman Spur\nNorth Marty, NV 00844-4666', NULL, '469 Caesar Pine', '98425', 'Dakotamouth', '+1-947-645-8031', '2021-10-08 18:05:06', NULL),
('5a533321-757a-4831-a57e-40e6cf2e24fa', '43db553b-21b2-4d4a-aa17-f741652fed48', NULL, 1, 'M.', 'Alysson Stokes', 'Kiera', 'McClure, Huels and Dare', '695 Turcotte Vista\nNew Dudley, MS 69879', NULL, '554 Eldred Center Suite 355', '10102-2528', 'West Reesechester', '+1 (248) 953-3777', '2021-10-08 18:05:06', NULL),
('64b72627-feb9-4d06-931b-b103569cc035', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', NULL, 0, 'M.', 'Dr. Edward White III', 'Bailey', 'Schumm-Pagac', '50293 Green Spur Apt. 084\nMrazland, DE 11068-6575', NULL, '45259 Guadalupe Isle Apt. 195', '54392-6329', 'Schultzfort', '+1 (360) 920-3272', '2021-10-08 18:05:06', NULL),
('73dd1ee1-0a08-4da5-960b-a8d788b4ef82', '5aa6ddb7-ad5a-46a8-a012-d09f6ce1b9a9', NULL, 0, 'Mme.', 'Rhiannon Quitzon', 'Matilda', 'Huels, Lind and Ward', '56922 Beaulah Stravenue\nKulasfort, SC 18337', NULL, '214 Timmy Parks Suite 077', '68336', 'McGlynnborough', '1-360-709-8854', '2021-10-08 18:05:06', NULL),
('7706f15c-3444-425a-838b-c99530f208de', '4bf48204-a68e-4c5e-be7c-7f31041b7e3d', NULL, 1, 'M.', 'Pascale Ziemann', 'Hunter', 'Schamberger-Champlin', '148 Tremaine Ridge\nLake Zita, CA 69713', NULL, '5190 Corkery Cliffs Apt. 202', '91191', 'Zacharybury', '469.281.7311', '2021-10-08 18:05:06', NULL),
('7854f560-eb26-45f0-ab78-358d838c4694', 'f08ece32-cf5e-4715-b7ef-495864443d47', NULL, 0, 'Mme.', 'Prof. Aiyana Friesen', 'Fredy', 'Gerlach-Kautzer', '86409 Aisha Burgs Apt. 219\nDickinsonshire, TN 41684', NULL, '7053 Aufderhar Summit Apt. 225', '34541', 'Port Kayceemouth', '+18149527521', '2021-10-08 18:05:06', NULL),
('7879e6a0-586c-4fc1-96af-a80853cdf016', '5aa6ddb7-ad5a-46a8-a012-d09f6ce1b9a9', NULL, 0, 'Mme.', 'Prof. Darrion Hettinger', 'Demarco', 'Schmitt-Armstrong', '4734 Reinger Curve Suite 223\nStrackeborough, NM 90033', NULL, '89330 Ratke Spring', '99556', 'Port Terryshire', '857.222.8424', '2021-10-08 18:05:06', NULL),
('78cc2e67-a50e-4e5e-b8cf-1f1eef61af0a', '4bf48204-a68e-4c5e-be7c-7f31041b7e3d', NULL, 1, 'Mme.', 'Aisha Will', 'Nayeli', 'Auer, Hane and Abshire', '792 Abernathy Inlet Apt. 141\nEast Shaynaview, OK 07420-2817', NULL, '15344 Feeney Path', '31701-9620', 'Lake Pearlchester', '929.757.8166', '2021-10-08 18:05:06', NULL),
('817ab943-a3e6-4536-b222-6f8b5feafaa8', 'f08ece32-cf5e-4715-b7ef-495864443d47', NULL, 1, 'M.', 'Daryl O\'Connell', 'Earnestine', 'Adams PLC', '8859 Cale Pike Apt. 523\nMilanfort, UT 38000-8134', NULL, '123 Vivian Greens Apt. 347', '86647-7911', 'West Andreannebury', '817-659-0871', '2021-10-08 18:05:06', NULL),
('8885e86d-3c5b-4483-ac34-d460103a1573', '5aa6ddb7-ad5a-46a8-a012-d09f6ce1b9a9', NULL, 0, 'Mme.', 'Marielle Zboncak', 'Guy', 'Mante and Sons', '97604 Kelsie Estates Apt. 787\nNew Vella, WV 94601-7659', NULL, '4084 Champlin Brook Suite 620', '03073', 'Hudsonland', '(351) 434-2972', '2021-10-08 18:05:06', NULL),
('8b2d9985-50a6-4910-b865-4eb865fa73a9', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', NULL, 0, 'M.', 'Dr. Manuel Auer', 'Lily', 'Howell Ltd', '5380 Vernice Light\nMaurineberg, NC 44918-4273', NULL, '6567 Dorris Courts Apt. 022', '51393', 'Opheliaburgh', '(603) 886-9274', '2021-10-08 18:05:06', NULL),
('8cdd7715-db1a-491c-b9c4-36eb55ec877b', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', NULL, 0, 'M.', 'Eldred Mayert', 'Muriel', 'Baumbach LLC', '754 VonRueden Village\nKubfurt, DC 88211', NULL, '989 Lela Extensions Apt. 508', '95856-9023', 'Sammiehaven', '+1.337.728.5454', '2021-10-08 18:05:06', NULL),
('8cfc5923-c9b8-4cc4-ba52-ee1f063e22be', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', NULL, 1, 'Mme.', 'Prof. Flo Mohr', 'Alfonzo', 'Schuster Group', '53120 Wuckert Neck\nPort Ezequielshire, MT 89228-8276', NULL, '8130 Koelpin Hollow Suite 940', '41566-5355', 'Thielmouth', '+1 (240) 561-4264', '2021-10-08 18:05:06', NULL),
('91759ec2-1af3-4aca-8976-63b108745858', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', NULL, 1, 'M.', 'Dorothea Bosco', 'Laurie', 'McClure, Macejkovic and Hickle', '370 Dibbert Plain\nWest Daniela, ID 55624', NULL, '96335 Ashton Canyon Suite 894', '22570', 'Alexandramouth', '+19514522032', '2021-10-08 18:05:06', NULL),
('945b8bb0-7ae0-4109-a9ca-b644d3e9e462', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', NULL, 0, 'Mme.', 'Mr. Vladimir Barrows MD', 'Clare', 'Kuhlman, Kohler and Rogahn', '587 Elsie Springs\nJustenmouth, SD 84997-2038', NULL, '209 Herzog Burgs Suite 022', '07670', 'West Huldaton', '+13346150802', '2021-10-08 18:05:06', NULL),
('984f3389-16d0-4e01-8261-eb4db916a7b8', 'f08ece32-cf5e-4715-b7ef-495864443d47', NULL, 0, 'Mme.', 'Lauretta McClure', 'Paul', 'Armstrong-Green', '10307 Mina Ports Apt. 886\nNorth Teaganbury, KY 39561', NULL, '243 Casper Underpass', '35852-1991', 'Ansleymouth', '1-848-622-6004', '2021-10-08 18:05:06', NULL),
('a1a2e3ae-f6b7-4d01-893d-f657483c317e', '43db553b-21b2-4d4a-aa17-f741652fed48', NULL, 0, 'M.', 'Prof. Isaias Hartmann Sr.', 'Cicero', 'Davis, Conroy and Kassulke', '153 Rylee Villages\nBernhardburgh, WI 90138-9422', NULL, '279 Julianne Extension', '03128-9596', 'Katherinetown', '(320) 722-1055', '2021-10-08 18:05:06', NULL),
('a672fa13-53eb-4906-89cc-b571f89d9253', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', NULL, 1, 'Mme.', 'Julien Runte', 'Dianna', 'Marvin Group', '9523 Walter Pass Suite 079\nMayertberg, UT 13017', NULL, '359 Hand Squares Suite 146', '86535', 'West Avis', '1-364-571-6818', '2021-10-08 18:05:06', NULL),
('a853b9ad-fa84-46ca-9609-7e22fd56aba6', '374e89ab-eaad-498c-ad02-dd40fb55b5aa', NULL, 1, 'Mme.', 'Dr. Alysha Jerde', 'Alba', 'Stamm, Gibson and Runolfsson', '93755 Brakus Dam\nAuerborough, WA 50816', NULL, '6240 Halvorson Lodge', '89615', 'Port Jolie', '1-820-719-7642', '2021-10-08 18:05:06', NULL),
('af9d7ee0-e7f1-4590-b3d9-fb862e058265', '5c67510a-cc8c-488d-93b5-412ea8ab1597', NULL, 1, 'Mme.', 'Kaia Feeney', 'Leanna', 'Wolff-Strosin', '5597 Greenfelder Burgs\nPort Virgil, OH 21499', NULL, '8347 Romaguera Plains Apt. 070', '68381-4019', 'Ethylmouth', '+12257796997', '2021-10-08 18:05:06', NULL),
('b1799f28-a58e-4b7d-bd30-7c789fca5ad1', '4bf48204-a68e-4c5e-be7c-7f31041b7e3d', NULL, 1, 'M.', 'Ariel Schinner III', 'Hester', 'Gibson-Osinski', '7189 Boyle Forges\nNorth Seamusborough, PA 14633', NULL, '491 Shane Fall', '16471', 'North Jessicaborough', '1-984-724-9379', '2021-10-08 18:05:06', NULL),
('b192f20e-f817-4b37-aa77-415da655c9ea', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', NULL, 0, 'Mme.', 'Myron Reynolds', 'Earnestine', 'Vandervort Ltd', '691 Jadon Route\nSouth Armand, MS 01128', NULL, '690 Caesar Crossroad', '24187-3383', 'Goyetteport', '+1-786-542-8727', '2021-10-08 18:05:06', NULL),
('b568e066-0334-4d0e-ae96-58fb8146e991', '05971113-b6a7-4cbc-a90d-46c82cb1d3b1', NULL, 1, 'M.', 'Myra Von', 'Kamryn', 'Reinger Inc', '244 Bogisich Camp\nHarrismouth, MT 43840', NULL, '226 Langworth Drive', '53829-4535', 'Oberbrunnerport', '682-307-3360', '2021-10-08 18:05:06', NULL),
('b7c02ccc-83a9-4792-a985-1ba66567837e', '43db553b-21b2-4d4a-aa17-f741652fed48', NULL, 1, 'Mme.', 'Prof. Kylie McKenzie IV', 'Dayana', 'Torp-McDermott', '70958 Calista Path\nSouth Lowellton, MN 53033-5492', NULL, '97847 Bauch Ways', '45021-9165', 'Schmittview', '+1 (580) 637-5460', '2021-10-08 18:05:06', NULL),
('bbd4136c-b66b-427a-940f-91f7693f2c72', '4bf48204-a68e-4c5e-be7c-7f31041b7e3d', NULL, 0, 'M.', 'Finn Spinka', 'Baron', 'Cummings-Yost', '8848 Trent Creek\nTrentstad, WV 96147-4564', NULL, '72607 Tobin Forges Apt. 200', '37490-6500', 'Elverastad', '432.474.0608', '2021-10-08 18:05:06', NULL),
('bc1ea134-2aeb-466f-b3ba-3ef4e31e6c8c', '5c67510a-cc8c-488d-93b5-412ea8ab1597', NULL, 1, 'Mme.', 'Dariana Waters Sr.', 'Hadley', 'Pacocha PLC', '38374 Hyatt Valleys Apt. 232\nHermannhaven, WV 15768-4525', NULL, '9113 Dannie Center', '53476', 'Hammeston', '920-419-4119', '2021-10-08 18:05:06', NULL),
('bcc71a63-4b8b-43d6-aed8-18f44a740dab', '4bf48204-a68e-4c5e-be7c-7f31041b7e3d', NULL, 0, 'M.', 'Nola Abbott', 'Gavin', 'Jerde, Veum and Stark', '2367 Mireya Greens Suite 713\nParisianburgh, LA 02851', NULL, '67308 White Row Suite 550', '98096-6124', 'West Camryn', '(408) 720-6599', '2021-10-08 18:05:06', NULL),
('be51680c-30e8-434b-aab0-a0112b3c49c3', '43db553b-21b2-4d4a-aa17-f741652fed48', NULL, 1, 'M.', 'Dr. Hillard Hintz II', 'Trudie', 'Zulauf Group', '40165 Tina Rapids Suite 885\nMrazborough, MT 80771', NULL, '47279 Marcus Cliffs Apt. 928', '92975-8670', 'Altenwerthport', '435.933.7165', '2021-10-08 18:05:06', NULL),
('bf347fba-6865-4888-95b7-11c623dcb2b2', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', NULL, 1, 'M.', 'Freeman Barrows', 'Michele', 'Mohr Group', '27660 Leila Avenue Suite 464\nStreichshire, NJ 30256-2959', NULL, '269 Conroy Rapids', '35242-4989', 'Hintzchester', '386-247-6244', '2021-10-08 18:05:06', NULL),
('c2a181a8-6c3a-4cfa-85ab-e83781cd7c50', '4bf48204-a68e-4c5e-be7c-7f31041b7e3d', NULL, 0, 'Mme.', 'Lola Crooks', 'Genesis', 'Murazik-Morar', '6274 Dashawn Port\nLake Sterlingborough, OH 89743', NULL, '73623 Okuneva Stream Apt. 950', '36993', 'Schmidtberg', '+1 (810) 965-4812', '2021-10-08 18:05:06', NULL),
('d77d4430-0cd7-48bd-96d5-0967700db941', 'f08ece32-cf5e-4715-b7ef-495864443d47', NULL, 1, 'M.', 'Hailey Bechtelar', 'Tara', 'Williamson Inc', '7162 Buckridge Glens\nPattieton, CO 51313-4582', NULL, '6821 Dandre Islands', '21839', 'Nyatown', '1-657-204-3341', '2021-10-08 18:05:06', NULL),
('d7bff5c1-db36-421e-83aa-8e8e09f19632', 'f075519b-f4f8-4ab5-9d7b-e6d188f6cc37', NULL, 0, 'M.', 'Willis Hettinger', 'Nathaniel', 'Weissnat, Jakubowski and Botsford', '6837 Kutch Islands Apt. 400\nLake Conor, OH 53003-8006', NULL, '1086 Bayer Avenue', '72669', 'North Aaliyah', '+1 (606) 404-5276', '2021-10-08 18:05:06', NULL),
('dd1b0982-6e61-40de-bddf-0f483783e8b7', 'f08ece32-cf5e-4715-b7ef-495864443d47', NULL, 1, 'Mme.', 'Mrs. Della Stehr', 'Alfreda', 'Heidenreich-Stokes', '17961 Stroman Course Apt. 545\nYundtland, CA 04569-8154', NULL, '183 Helmer Alley Suite 371', '82022', 'West Stella', '+1 (830) 253-5687', '2021-10-08 18:05:06', NULL),
('dd366284-5d07-41f0-9f5d-c7ec65f070b7', 'f08ece32-cf5e-4715-b7ef-495864443d47', NULL, 1, 'Mme.', 'Mr. Okey Bednar Jr.', 'Fern', 'Schowalter and Sons', '39974 Von Mews\nNorth Flavio, AL 26120-6061', NULL, '73028 Vicky Vista Apt. 635', '69777', 'West Violetbury', '(254) 255-6051', '2021-10-08 18:05:06', NULL),
('e0c2112d-466e-4369-999f-178a1dff6b2f', '43db553b-21b2-4d4a-aa17-f741652fed48', NULL, 1, 'M.', 'Lorenzo Marks', 'Vivianne', 'Gaylord Group', '236 Larkin Prairie\nNorth Darbyshire, IN 81978-0293', NULL, '6545 Keeling Gardens', '01558-1885', 'Waelchimouth', '938-572-0190', '2021-10-08 18:05:06', NULL),
('e1620edb-cd53-4f80-809d-9e5d1ff432f5', '05971113-b6a7-4cbc-a90d-46c82cb1d3b1', NULL, 1, 'M.', 'Miss Antonette Runolfsdottir DVM', 'Dasia', 'Jacobson, Donnelly and Kutch', '6811 Vanessa Ramp\nLisandromouth, CT 94154-5830', NULL, '3136 Ward Underpass', '57444', 'New Renee', '+1-210-651-4030', '2021-10-08 18:05:06', NULL),
('e19afd55-f16b-4c63-bdbc-5fac10617b6c', 'f075519b-f4f8-4ab5-9d7b-e6d188f6cc37', NULL, 1, 'M.', 'Treva Beer V', 'Felicity', 'Upton-Bednar', '17345 Owen Brooks Suite 943\nWaylonburgh, WA 76164', NULL, '3119 Lonny Ville', '61588-5048', 'Zacharystad', '540-289-1476', '2021-10-08 18:05:06', NULL),
('e2d2c9ce-19ad-468a-bc82-7f1bf069fd39', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', NULL, 1, 'M.', 'Charlie Padberg V', 'Adolfo', 'Greenfelder, O\'Connell and Koss', '9467 Blanda Street Apt. 551\nPort Katherineland, OR 81133', NULL, '3931 Damaris Squares Suite 049', '47759-6949', 'East Linneatown', '1-901-442-4494', '2021-10-08 18:05:06', NULL),
('e44509fd-dc65-4099-904d-b0473cce9443', '05971113-b6a7-4cbc-a90d-46c82cb1d3b1', NULL, 0, 'Mme.', 'Ari Sanford', 'Robyn', 'Hettinger-Brekke', '843 Leon Mill\nEast Marguerite, AR 70704', NULL, '488 Antonette Islands Apt. 022', '21174-4382', 'Jettshire', '323.844.0038', '2021-10-08 18:05:06', NULL),
('e5791985-ed9c-4389-9fa5-b666d13e74d9', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', NULL, 0, 'M.', 'Bailee Dach IV', 'Paris', 'Schuppe, Kuhic and Walker', '69968 Reynold Court\nNorth Edville, NV 86954-3577', NULL, '5475 Caleb Field Apt. 320', '00494', 'North Lindsayberg', '1-541-531-3510', '2021-10-08 18:05:06', NULL),
('e5caaacf-5bef-4433-81ab-d0bacecbaa49', '4bf48204-a68e-4c5e-be7c-7f31041b7e3d', NULL, 1, 'M.', 'Mr. Stephen Thiel', 'Tristian', 'Konopelski Inc', '253 McLaughlin Lock Apt. 078\nDibbertmouth, MT 21985-8234', NULL, '5256 Ullrich Cape Apt. 427', '14061', 'Hermannbury', '828-350-5604', '2021-10-08 18:05:06', NULL),
('e8dd3a9f-36f5-4d7f-8cc5-4d7ea87caf32', '43db553b-21b2-4d4a-aa17-f741652fed48', NULL, 1, 'M.', 'Magnolia Grady', 'Isabelle', 'Rippin PLC', '973 Savannah Rapids\nMohrport, MI 53751', NULL, '498 Littel Center', '48970', 'West Darius', '+1-754-336-4659', '2021-10-08 18:05:06', NULL),
('f04b034c-6fef-4f7e-8c1f-82b8653b4c12', '5aa6ddb7-ad5a-46a8-a012-d09f6ce1b9a9', NULL, 0, 'Mme.', 'Jaylan Kling', 'Destany', 'Homenick Inc', '141 Josefa Village Apt. 140\nEast Elna, WA 60349-4737', NULL, '635 Brionna Knolls Apt. 538', '64561-6880', 'Jerrellberg', '+1-423-680-1280', '2021-10-08 18:05:06', NULL),
('f0558b22-6f40-4c49-9b22-87d5b4f7d1b8', '05971113-b6a7-4cbc-a90d-46c82cb1d3b1', NULL, 0, 'Mme.', 'Akeem Thiel', 'Alfred', 'Haag-Schowalter', '4933 Emmy Island Apt. 413\nSouth Jedborough, ID 57397-8594', NULL, '99522 Caitlyn Bypass', '74602-1327', 'New Laurenfort', '+1-520-820-4953', '2021-10-08 18:05:06', NULL),
('f1909fc9-fed5-4e10-85a8-048fc3b4e28a', '374e89ab-eaad-498c-ad02-dd40fb55b5aa', NULL, 1, 'M.', 'Brandt Dibbert', 'Lina', 'Sipes-Heathcote', '3571 Reinger Track Suite 305\nNakiafurt, KY 26992', NULL, '675 Adelia Prairie', '38160', 'North Alvenaton', '432-871-2307', '2021-10-08 18:05:06', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `attachment`
--

CREATE TABLE `attachment` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `tree_root` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `parent_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `lft` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `tree_root`, `parent_id`, `name`, `slug`, `description`, `lft`, `lvl`, `rgt`, `enabled`) VALUES
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '176c9380-0f3d-49bc-8a38-4959b3b939d7', NULL, 'Health', 'health', '', 1, 0, 2, 1),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '5e0b479a-75e1-4a4d-9f6b-3e26721274e2', NULL, 'Garden', 'garden', '', 1, 0, 2, 1),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '89f83119-65c3-439f-bdae-b3ec0226bd0d', NULL, 'Clothing', 'clothing', '', 1, 0, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `category_product`
--

CREATE TABLE `category_product` (
  `category_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category_product`
--

INSERT INTO `category_product` (`category_id`, `product_id`) VALUES
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '0dd1b14f-f264-4d92-becb-856f59ed3d59'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '1aa5c2c3-6e28-47c9-a4f9-239df8ff2078'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '2792fed8-74ab-4dcc-b9bb-f351d267072d'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '347d4962-751c-4ccc-9bf2-322f0bbb259f'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '474668f0-4ea6-4813-86d9-ffe82a22e520'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '4c7c9ce2-f7ca-466b-a250-3b211b19df35'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '4e646d96-5fda-43f5-857c-467f9b98cd72'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '7ba51261-8d09-452c-939c-9e3743aa8c61'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '7d986836-d4e2-489f-8600-502f5fd027c7'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '828f05a2-c61e-479c-b7e2-bf2bed475247'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '86e01cb1-53ac-4814-a148-de3464e5bc0c'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '995e5d30-8647-4ead-9a30-a070716ef178'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '9c41e603-e820-46ed-b3f9-8cde989a9214'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', '9ddcb0a4-b6ed-4986-914d-e8874b707d14'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', 'ac890b97-5d4e-45a3-b7ee-ec1f22592fa9'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', 'c068d3d9-38a1-4409-bef1-065f30e66c61'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', 'c70fcb7d-9419-42a8-b0df-778082fb5a68'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', 'c972723c-13f6-4d7c-ae27-392d856b3b3c'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', 'cea3674b-1dc1-4d95-b8f8-1b5d6088f23e'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', 'dc3d72d3-79b9-456e-8177-32e4563aecbe'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', 'e1ef66b5-4238-4868-84b5-ee5ec75b3238'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', 'f83de98e-8715-495c-8325-823cf31bad82'),
('176c9380-0f3d-49bc-8a38-4959b3b939d7', 'fe72f30b-fbfb-48a5-ac9f-9e9a685b143a'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '00138ad6-8281-42cf-bb9e-1eb0b05c4cc5'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '0394393c-75c4-4866-96ac-7a53d12cb844'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '1a53fef4-73dc-46b2-ae45-a74902902b60'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '3ca563f1-fd69-495b-bd27-a6b387e196ae'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '474668f0-4ea6-4813-86d9-ffe82a22e520'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '4c7c9ce2-f7ca-466b-a250-3b211b19df35'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '559b81d0-fc22-44a7-a359-e8eaedb33d6f'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '6c34d908-1e42-49fe-861d-48dd188375ce'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '6c727b6b-f1ae-4a7b-8b6c-f23b4f8cf0b2'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '6c7667bd-bfd4-4513-9bf3-0246014c6380'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '762eb404-ee76-47ba-a62b-e6a3fd3835ed'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '7ba51261-8d09-452c-939c-9e3743aa8c61'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '8445c042-76c0-4a3c-bb06-ddcd0975bf9b'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', '89efbdc7-af6e-440d-81ca-299931ea3600'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', 'af0d5a53-ea3a-4ff0-b152-cf2c9e3b9498'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', 'bde51636-8a5b-45eb-8ee2-b73a10c457d8'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', 'cea3674b-1dc1-4d95-b8f8-1b5d6088f23e'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', 'dc3d72d3-79b9-456e-8177-32e4563aecbe'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', 'eca325e7-af9b-414f-bae5-f08cc1971690'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', 'f34268e5-6ef1-434c-9281-d64c38c984c6'),
('5e0b479a-75e1-4a4d-9f6b-3e26721274e2', 'fe72f30b-fbfb-48a5-ac9f-9e9a685b143a'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '0394393c-75c4-4866-96ac-7a53d12cb844'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '07159f2e-9c74-4afe-b292-4eb49d2e631f'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '0a749cb0-58b1-42d7-a76e-4aa49c3e2f11'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '0dd1b14f-f264-4d92-becb-856f59ed3d59'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '13bc647d-5f7b-43c6-9f11-ed1d583f787e'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '1aa5c2c3-6e28-47c9-a4f9-239df8ff2078'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '3397e801-6cd4-47c0-bb8b-cdea8f45fd29'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '347d4962-751c-4ccc-9bf2-322f0bbb259f'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '5e465a7b-2e4f-460d-b7df-513247860e39'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '604ea729-2659-405a-9af4-00a9c0c25cb4'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '735c11ce-305a-4d97-9f90-40a39d83a435'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '762eb404-ee76-47ba-a62b-e6a3fd3835ed'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '80fac375-f318-420c-9d35-0822cfad5685'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '828f05a2-c61e-479c-b7e2-bf2bed475247'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', '89efbdc7-af6e-440d-81ca-299931ea3600'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', 'be70e92c-0bb5-4546-a5b0-b508e2da3b0c'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', 'c70fcb7d-9419-42a8-b0df-778082fb5a68'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', 'd94f661c-2f19-4091-900c-14f84d25268a'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', 'de88e568-eb94-4cdb-bcde-b4f1cba9d244'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', 'e0ab3720-20e7-4222-8d7b-a2cea76e6aaa'),
('89f83119-65c3-439f-bdae-b3ec0226bd0d', 'f83de98e-8715-495c-8325-823cf31bad82');

-- --------------------------------------------------------

--
-- Structure de la table `colissimo`
--

CREATE TABLE `colissimo` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `country_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `range_value_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `colissimo`
--

INSERT INTO `colissimo` (`id`, `country_id`, `range_value_id`, `price`) VALUES
('02577268-1d75-4597-a6dc-05b6b8480dfb', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', 'c5462749-f519-41f0-8e79-4f973b7afefc', 436.85),
('03fd9425-8c26-4ddc-b9cb-f79d611f63d6', '05971113-b6a7-4cbc-a90d-46c82cb1d3b1', '9bfa2c68-a891-4b7a-a7fa-129e2793dd06', 218.16),
('115c8f3c-cc07-47f9-ad23-f4dd9d7d5ff8', '43db553b-21b2-4d4a-aa17-f741652fed48', '8bbd4480-2921-44f2-82e3-89448835f928', 127.73),
('15de022e-a47e-4862-96c1-2b0e5d50b76a', '374e89ab-eaad-498c-ad02-dd40fb55b5aa', '523dddd4-23d7-4db4-99b4-0396c05157ab', 76.35),
('1f27e7e6-f5ce-4617-a106-5f8a579eec09', '5aa6ddb7-ad5a-46a8-a012-d09f6ce1b9a9', '523dddd4-23d7-4db4-99b4-0396c05157ab', 439.1),
('1f356802-667e-436a-b7b5-59272bb97f64', 'f08ece32-cf5e-4715-b7ef-495864443d47', '23dc7e10-d1b9-4d1d-8140-42f2c44a5dd2', 348.85),
('2df5fc67-8368-486f-8db4-717c27785202', '64e928be-1bcb-4aa5-b806-9438dc78f414', '8bbd4480-2921-44f2-82e3-89448835f928', 64.45),
('2ee906a6-34d1-4fa6-9e42-e2605ac7d61a', '43db553b-21b2-4d4a-aa17-f741652fed48', '523dddd4-23d7-4db4-99b4-0396c05157ab', 314.13),
('304e7745-b7af-4218-a86a-4c3ad1e6ac8a', '5aa6ddb7-ad5a-46a8-a012-d09f6ce1b9a9', '23dc7e10-d1b9-4d1d-8140-42f2c44a5dd2', 293.94),
('30da156c-f02b-44e5-9029-b5207d4c0f90', '43db553b-21b2-4d4a-aa17-f741652fed48', '8bbd4480-2921-44f2-82e3-89448835f928', 332.11),
('33836015-4db8-43ea-9fd5-35388ee8cfdc', '5c67510a-cc8c-488d-93b5-412ea8ab1597', '9bfa2c68-a891-4b7a-a7fa-129e2793dd06', 363.62),
('49719d25-708a-488b-a887-817b89163bee', 'f075519b-f4f8-4ab5-9d7b-e6d188f6cc37', '39517b6f-af9e-4313-89a7-1d416bb54359', 406.53),
('51ed0a4e-e199-4cd3-832c-b8833d72e566', '4bf48204-a68e-4c5e-be7c-7f31041b7e3d', '39517b6f-af9e-4313-89a7-1d416bb54359', 127.46),
('55e25a62-8437-467d-b9d9-7285084d8f70', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', '8bbd4480-2921-44f2-82e3-89448835f928', 237.19),
('5dba13fb-73b6-4e76-9159-12688a3101d1', '5c67510a-cc8c-488d-93b5-412ea8ab1597', '39517b6f-af9e-4313-89a7-1d416bb54359', 488.97),
('6bd86300-ad37-4ee3-878a-55ef8dc48a81', 'f075519b-f4f8-4ab5-9d7b-e6d188f6cc37', '23dc7e10-d1b9-4d1d-8140-42f2c44a5dd2', 66.83),
('71ff6b7f-c443-4e09-af8b-1b19d13b0f2c', '5c67510a-cc8c-488d-93b5-412ea8ab1597', 'c5462749-f519-41f0-8e79-4f973b7afefc', 52.4),
('7575597c-9eec-4db7-81ec-994300c811bc', '5aa6ddb7-ad5a-46a8-a012-d09f6ce1b9a9', 'c5462749-f519-41f0-8e79-4f973b7afefc', 449.7),
('7a6d6a76-5b13-42bd-8bb9-d4424181196f', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', '8bbd4480-2921-44f2-82e3-89448835f928', 76.87),
('818e7b8a-1e4f-4211-821e-86e5ab8d7c7b', 'f08ece32-cf5e-4715-b7ef-495864443d47', '9bfa2c68-a891-4b7a-a7fa-129e2793dd06', 193.4),
('969d7b3b-80f6-4b3d-a4aa-10dd0398446e', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', '8bbd4480-2921-44f2-82e3-89448835f928', 490.17),
('981f8831-aab1-42a6-ad3e-29337594faa5', 'f08ece32-cf5e-4715-b7ef-495864443d47', '9bfa2c68-a891-4b7a-a7fa-129e2793dd06', 133.09),
('99aac86a-74e9-4863-b8b9-c64fcc0b49a7', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', '9bfa2c68-a891-4b7a-a7fa-129e2793dd06', 143.12),
('9cb35631-8903-4892-a152-6b5ceca1d3e2', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', '39517b6f-af9e-4313-89a7-1d416bb54359', 483.67),
('a3beab06-eacb-4ee6-bcd2-c6a04806b0a7', '4bf48204-a68e-4c5e-be7c-7f31041b7e3d', '8bbd4480-2921-44f2-82e3-89448835f928', 302.05),
('a71bae89-37d4-40b5-bf5c-0219dca4bcec', 'f075519b-f4f8-4ab5-9d7b-e6d188f6cc37', '523dddd4-23d7-4db4-99b4-0396c05157ab', 409.91),
('ac3abfe3-30ba-4c52-b88e-3bdc8c5ede8a', 'f08ece32-cf5e-4715-b7ef-495864443d47', '39517b6f-af9e-4313-89a7-1d416bb54359', 134.69),
('afddc951-a0a5-4bce-9f1a-159c61361551', '05971113-b6a7-4cbc-a90d-46c82cb1d3b1', '8bbd4480-2921-44f2-82e3-89448835f928', 460.66),
('b2e71ea2-f411-49c6-85ed-43471ebecf30', 'f075519b-f4f8-4ab5-9d7b-e6d188f6cc37', '39517b6f-af9e-4313-89a7-1d416bb54359', 237.56),
('b7ca8535-8351-43b1-b9c1-83d5f5e251d0', '374e89ab-eaad-498c-ad02-dd40fb55b5aa', '23dc7e10-d1b9-4d1d-8140-42f2c44a5dd2', 259.83),
('b8d2967a-209c-4365-a1ac-6029683b8420', '05971113-b6a7-4cbc-a90d-46c82cb1d3b1', '8bbd4480-2921-44f2-82e3-89448835f928', 418),
('bbc2edc7-274e-4aa0-ba87-5ec81ce00516', 'f08ece32-cf5e-4715-b7ef-495864443d47', '8bbd4480-2921-44f2-82e3-89448835f928', 382.9),
('c237bf1d-689a-4791-95ad-27f33092572f', '5c67510a-cc8c-488d-93b5-412ea8ab1597', '39517b6f-af9e-4313-89a7-1d416bb54359', 493.67),
('c71d68f4-f720-46a3-8d4c-8aad5dd935d9', '374e89ab-eaad-498c-ad02-dd40fb55b5aa', '8bbd4480-2921-44f2-82e3-89448835f928', 466.43),
('c79911ee-b775-45b4-9951-a61864f5092b', '5c67510a-cc8c-488d-93b5-412ea8ab1597', '9bfa2c68-a891-4b7a-a7fa-129e2793dd06', 234.25),
('d19f7055-dbb4-46eb-b7bd-9e458cc2a1e1', '5c67510a-cc8c-488d-93b5-412ea8ab1597', '8bbd4480-2921-44f2-82e3-89448835f928', 128.87),
('d306e88c-bbcf-412e-a662-cd9e9bffe20c', '05971113-b6a7-4cbc-a90d-46c82cb1d3b1', '39517b6f-af9e-4313-89a7-1d416bb54359', 224.57),
('d5f23395-acef-4a2b-807a-9681139ca4a5', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', 'c5462749-f519-41f0-8e79-4f973b7afefc', 78.81),
('d8e49d20-9011-431f-9106-a517f42a35da', '64e928be-1bcb-4aa5-b806-9438dc78f414', '8bbd4480-2921-44f2-82e3-89448835f928', 224.34),
('dbf38ce9-da73-4cd4-9aaa-9044665a20b2', '374e89ab-eaad-498c-ad02-dd40fb55b5aa', '9bfa2c68-a891-4b7a-a7fa-129e2793dd06', 473.63),
('e0fcc0f2-f6ac-4c64-9f1a-8c21a4bf030e', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', '9bfa2c68-a891-4b7a-a7fa-129e2793dd06', 109.83),
('e1d6c1ed-9c48-4e5a-b382-eb35a48c8a31', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', '23dc7e10-d1b9-4d1d-8140-42f2c44a5dd2', 84.09),
('e6e4e34a-09f2-4005-8687-b0313a29d836', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', '23dc7e10-d1b9-4d1d-8140-42f2c44a5dd2', 436.8),
('eec71c75-5ab1-4544-9bda-c6082c31828c', '21d5d0f5-b335-4900-8f98-5d4ef145beb8', '23dc7e10-d1b9-4d1d-8140-42f2c44a5dd2', 415.27),
('efd3a449-1177-4055-bcb1-119e02d5606c', '374e89ab-eaad-498c-ad02-dd40fb55b5aa', '23dc7e10-d1b9-4d1d-8140-42f2c44a5dd2', 129.08),
('f4f89bfd-3163-42e2-a14b-08c14a8bf71d', '4bf48204-a68e-4c5e-be7c-7f31041b7e3d', '39517b6f-af9e-4313-89a7-1d416bb54359', 383.5),
('f79accfc-d819-48b2-bede-816c10906937', '374e89ab-eaad-498c-ad02-dd40fb55b5aa', '39517b6f-af9e-4313-89a7-1d416bb54359', 311.41),
('f8b234dd-1d25-4bee-bbd5-a89c220c9071', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', '23dc7e10-d1b9-4d1d-8140-42f2c44a5dd2', 244.3),
('f934e761-8685-4096-b77d-9f21da8b2ffd', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', '8bbd4480-2921-44f2-82e3-89448835f928', 357.27),
('fb93f80c-c69c-443e-a908-17fbd981103c', 'ea69fb00-7562-4fbf-9b53-a101e29ab9a6', '523dddd4-23d7-4db4-99b4-0396c05157ab', 115.75);

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `range_value_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`id`, `range_value_id`, `name`, `tax`) VALUES
('05971113-b6a7-4cbc-a90d-46c82cb1d3b1', NULL, 'Micronesia', 13.11),
('21d5d0f5-b335-4900-8f98-5d4ef145beb8', NULL, 'Lithuania', 16.89),
('374e89ab-eaad-498c-ad02-dd40fb55b5aa', NULL, 'Norfolk Island', 17.96),
('43db553b-21b2-4d4a-aa17-f741652fed48', NULL, 'Malawi', 19.36),
('4bf48204-a68e-4c5e-be7c-7f31041b7e3d', NULL, 'Iran', 19.25),
('5aa6ddb7-ad5a-46a8-a012-d09f6ce1b9a9', NULL, 'Azerbaijan', 19.6),
('5c67510a-cc8c-488d-93b5-412ea8ab1597', NULL, 'Monaco', 6.67),
('64e928be-1bcb-4aa5-b806-9438dc78f414', NULL, 'Papua New Guinea', 12.4),
('ea69fb00-7562-4fbf-9b53-a101e29ab9a6', NULL, 'Cameroun', 13),
('f075519b-f4f8-4ab5-9d7b-e6d188f6cc37', NULL, 'Bhutan', 11.85),
('f08ece32-cf5e-4715-b7ef-495864443d47', NULL, 'Australia', 16.48);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210608063631', '2021-08-15 08:41:41', 36652),
('DoctrineMigrations\\Version20210820095210', '2021-08-20 09:53:36', 2420),
('DoctrineMigrations\\Version20210923090506', '2021-09-23 10:06:12', 1292);

-- --------------------------------------------------------

--
-- Structure de la table `gateway_config`
--

CREATE TABLE `gateway_config` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `gateway_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `factory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config` json NOT NULL COMMENT '(DC2Type:json_array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `state_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `billing_address_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `shipping_address_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping` double DEFAULT NULL,
  `total` double NOT NULL,
  `tax` double DEFAULT NULL,
  `purchase_order` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pick` tinyint(1) DEFAULT '0',
  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `checkout_completed_at` datetime DEFAULT NULL,
  `checkout_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cart',
  `token_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_product`
--

CREATE TABLE `order_product` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `order_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `product_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price_gross` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `page`
--

INSERT INTO `page` (`id`, `name`, `slug`, `content`, `created_at`, `updated_at`) VALUES
('302e25e0-d503-4054-a6df-7f290f7a3efa', 'Conditons générales de vente', 'conditions-generales-de-vente', 'Dolor cumque alias consequatur vero laboriosam unde. Ut consequatur laudantium non nemo adipisci iste. Voluptas nihil ullam tempore nostrum. Quos minus provident sit.', NULL, NULL),
('632d3fa4-2251-4775-8440-95cd8fd63454', 'Respect de l\'environnement', 'respect-environnement', 'Ullam id maiores hic voluptas. Veniam magni iusto dolores. Accusamus cupiditate impedit repellendus ab. Aut nulla sequi quasi laboriosam omnis voluptas vel.', NULL, NULL),
('b773c5bb-0cd2-4fdb-bd1f-40ce9f1a7e76', 'Mandat administratif', 'mandat-administratif', 'Dolores ab aut fuga illum. Pariatur sit et at quia officiis in ipsam minus. Provident et dolor rerum nihil consectetur aut. Eveniet ipsam saepe quam. Non dicta quia sint a.', NULL, NULL),
('b9418703-ccc1-4f55-bfc8-205a55d8dfdd', 'Livraisons', 'livraisons', 'Ex sed consectetur dolorem aspernatur veniam recusandae voluptatem. A aut dicta tenetur optio. Fugit reprehenderit animi non dolorum.', NULL, NULL),
('d14238b3-8584-4528-86cd-abe6f8c1dc55', 'Mentions légales', 'mentions-legales', 'Inventore quod odio veniam quia eum consectetur. Enim quia voluptatem reiciendis nemo quas recusandae. Deserunt qui sit nihil et deserunt.', NULL, NULL),
('e891c675-0c6b-49e3-a4be-1b89ba13f0a4', 'Politique de confidentialité', 'politique-de-confidentialite', 'Omnis quis autem minima suscipit. Optio autem consequatur autem sunt. Eveniet voluptas placeat illum ab nobis. Accusamus sapiente quia iste nesciunt quasi est praesentium magnam.', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE `payment` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `method_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `order_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` json NOT NULL COMMENT '(DC2Type:json_array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `gateway_config_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payment_token`
--

CREATE TABLE `payment_token` (
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:object)',
  `after_url` longtext COLLATE utf8mb4_unicode_ci,
  `target_url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gateway_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `image_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `weight` double NOT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `quantity_alert` int(11) NOT NULL DEFAULT '10',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` longtext COLLATE utf8mb4_unicode_ci,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `image_id`, `name`, `slug`, `price`, `weight`, `is_active`, `quantity`, `quantity_alert`, `description`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
('00138ad6-8281-42cf-bb9e-1eb0b05c4cc5', NULL, 'Synergistic Wool Knife', 'synergistic-wool-knife', 1720, 6, 0, 4, 10, 'Modi mollitia sequi voluptas quisquam iste perferendis autem est. Ea impedit est iure maxime sit nemo omnis.', '', '', '2021-10-08 18:05:06', NULL),
('0394393c-75c4-4866-96ac-7a53d12cb844', NULL, 'Awesome Concrete Hat', 'awesome-concrete-hat', 1438, 43, 1, 6, 10, 'Deleniti fugiat rem voluptatum fugiat eum ut. Est repudiandae sint eos. Eum veniam nostrum nostrum. Nobis aut aliquid doloremque vel.', '', '', '2021-10-08 18:05:06', NULL),
('07159f2e-9c74-4afe-b292-4eb49d2e631f', NULL, 'Ergonomic Iron Computer', 'ergonomic-iron-computer', 1647, 9, 1, 2, 10, 'Ab eaque voluptate aliquid maxime. Sequi veniam labore odit. Sint earum perferendis amet soluta quo quaerat nihil. Eius error molestias tempore maiores modi.', '', '', '2021-10-08 18:05:06', NULL),
('0a749cb0-58b1-42d7-a76e-4aa49c3e2f11', NULL, 'Gorgeous Silk Plate', 'gorgeous-silk-plate', 613, 30, 0, 2, 10, 'Quis deserunt minus alias nobis. Quae voluptatem itaque voluptatem sapiente non. Quis numquam voluptatem culpa totam porro consequatur molestias. Non hic qui et libero aperiam commodi dolor quos.', '', '', '2021-10-08 18:05:06', NULL),
('0dd1b14f-f264-4d92-becb-856f59ed3d59', NULL, 'Small Aluminum Knife', 'small-aluminum-knife', 324, 10, 1, 6, 10, 'Sit aut numquam tempora quidem consequuntur ipsam. Quibusdam quis ut quos ducimus nemo quos. Numquam dicta pariatur omnis.', '', '', '2021-10-08 18:05:06', NULL),
('13bc647d-5f7b-43c6-9f11-ed1d583f787e', NULL, 'Synergistic Silk Bag', 'synergistic-silk-bag', 1160, 43, 1, 4, 10, 'Accusantium alias reprehenderit veritatis quo eos doloribus et. Est enim totam necessitatibus illum. Vitae quos officiis voluptatibus cupiditate cupiditate enim.', '', '', '2021-10-08 18:05:06', NULL),
('1a53fef4-73dc-46b2-ae45-a74902902b60', NULL, 'Fantastic Linen Coat', 'fantastic-linen-coat', 663, 43, 0, 5, 10, 'Quia quod at et at accusamus repellat corrupti. Ab tempora est officia sapiente eos. Corrupti maxime ut tenetur aut molestiae.', '', '', '2021-10-08 18:05:06', NULL),
('1aa5c2c3-6e28-47c9-a4f9-239df8ff2078', NULL, 'Small Bronze Watch', 'small-bronze-watch', 51, 9, 1, 5, 10, 'Qui aperiam in magnam quia et itaque molestias ea. Maxime non animi nisi fugit magnam suscipit. Aut expedita labore consequatur et officia iusto.', '', '', '2021-10-08 18:05:06', NULL),
('2792fed8-74ab-4dcc-b9bb-f351d267072d', NULL, 'Practical Silk Pants', 'practical-silk-pants', 718, 36, 1, 3, 10, 'Eos assumenda expedita rerum nesciunt. Consequuntur voluptates et dolores labore. Numquam expedita corrupti quidem earum est sit dolores. Id cupiditate et sunt suscipit.', '', '', '2021-10-08 18:05:06', NULL),
('3397e801-6cd4-47c0-bb8b-cdea8f45fd29', NULL, 'Small Bronze Shoes', 'small-bronze-shoes', 856, 12, 0, 5, 10, 'Hic ducimus expedita et voluptas molestiae et. Quia hic cupiditate sequi dicta velit. Nihil in magnam iure optio et aut nam aspernatur.', '', '', '2021-10-08 18:05:06', NULL),
('347d4962-751c-4ccc-9bf2-322f0bbb259f', NULL, 'Gorgeous Copper Car', 'gorgeous-copper-car', 223, 40, 0, 5, 10, 'Quos atque eum odit nihil ut dolores. Est dolore rerum est inventore sunt ipsam. Beatae accusantium architecto et tempore. Error aspernatur quaerat voluptatem et.', '', '', '2021-10-08 18:05:06', NULL),
('3ca563f1-fd69-495b-bd27-a6b387e196ae', NULL, 'Fantastic Iron Bag', 'fantastic-iron-bag', 962, 16, 0, 2, 10, 'Ut delectus voluptate esse ut incidunt. Dolorem esse eum distinctio pariatur aut quia impedit. Illo eius molestias quia quia ullam eveniet rerum. Qui nam qui harum.', '', '', '2021-10-08 18:05:06', NULL),
('474668f0-4ea6-4813-86d9-ffe82a22e520', NULL, 'Durable Cotton Hat', 'durable-cotton-hat', 615, 36, 0, 6, 10, 'Aliquam maiores quia numquam ea voluptas aut qui placeat. Dolor doloremque qui quis sapiente velit rerum eligendi. Rem nemo natus architecto eum. Id dolor voluptatem ut.', '', '', '2021-10-08 18:05:06', NULL),
('4c7c9ce2-f7ca-466b-a250-3b211b19df35', NULL, 'Durable Steel Bag', 'durable-steel-bag', 1482, 14, 0, 3, 10, 'Eveniet sequi voluptatem quos deserunt omnis in sint. Et tenetur cumque eos ipsum et dolor provident. Nihil laboriosam deleniti quibusdam dolorem. Incidunt voluptate laborum enim qui voluptas earum.', '', '', '2021-10-08 18:05:06', NULL),
('4e646d96-5fda-43f5-857c-467f9b98cd72', NULL, 'Heavy Duty Leather Bag', 'heavy-duty-leather-bag', 67, 7, 1, 3, 10, 'Dolorum sequi quia doloremque earum vitae in. Dolores ratione eos rerum nesciunt sapiente aspernatur iste repellendus. Non molestiae sint vel. Fugiat vel laudantium et cum et.', '', '', '2021-10-08 18:05:06', NULL),
('559b81d0-fc22-44a7-a359-e8eaedb33d6f', NULL, 'Synergistic Rubber Wallet', 'synergistic-rubber-wallet', 1630, 26, 1, 3, 10, 'Nihil eius magni aspernatur tenetur. Harum sequi dolore distinctio est perspiciatis autem tempore. Ut quae iste reprehenderit. Consequatur aut dolor quam minima est.', '', '', '2021-10-08 18:05:06', NULL),
('5e465a7b-2e4f-460d-b7df-513247860e39', NULL, 'Synergistic Copper Pants', 'synergistic-copper-pants', 1243, 45, 1, 2, 10, 'Odit voluptas dolor dignissimos consequuntur quasi. Et et voluptates esse deleniti. Rerum asperiores vitae atque voluptatem. Et voluptatum et sed nihil omnis sint.', '', '', '2021-10-08 18:05:06', NULL),
('604ea729-2659-405a-9af4-00a9c0c25cb4', NULL, 'Durable Paper Bench', 'durable-paper-bench', 1186, 23, 0, 4, 10, 'Et nam rerum perferendis voluptatibus quisquam quae. Distinctio quo voluptates odio ipsam porro aut dicta. Nihil ullam qui saepe sunt deserunt. Id architecto numquam adipisci quasi.', '', '', '2021-10-08 18:05:06', NULL),
('6c34d908-1e42-49fe-861d-48dd188375ce', NULL, 'Practical Granite Lamp', 'practical-granite-lamp', 1655, 12, 0, 4, 10, 'Quis voluptatem quod est aliquid aut est. Repellendus esse ratione dignissimos. Soluta fugit tenetur doloremque quae magni et porro.', '', '', '2021-10-08 18:05:06', NULL),
('6c727b6b-f1ae-4a7b-8b6c-f23b4f8cf0b2', NULL, 'Aerodynamic Cotton Gloves', 'aerodynamic-cotton-gloves', 1098, 31, 1, 4, 10, 'Dolor sit dolor accusamus hic. Necessitatibus maxime dolor est cupiditate. Laboriosam cumque et porro quia ut eligendi ut.', '', '', '2021-10-08 18:05:06', NULL),
('6c7667bd-bfd4-4513-9bf3-0246014c6380', NULL, 'Gorgeous Bronze Bottle', 'gorgeous-bronze-bottle', 1173, 19, 1, 6, 10, 'Quod ratione quidem odit unde quis ex. Blanditiis est autem est incidunt a aut dolorem consequatur. Asperiores velit at dolorem error non laboriosam vero.', '', '', '2021-10-08 18:05:06', NULL),
('735c11ce-305a-4d97-9f90-40a39d83a435', NULL, 'Heavy Duty Wool Table', 'heavy-duty-wool-table', 1615, 29, 0, 2, 10, 'Consequatur rerum sed repellat velit eius aperiam corporis. Ad hic veritatis et vel. Officiis ratione quam et voluptatem.', '', '', '2021-10-08 18:05:06', NULL),
('762eb404-ee76-47ba-a62b-e6a3fd3835ed', NULL, 'Incredible Wooden Keyboard', 'incredible-wooden-keyboard', 1169, 44, 0, 6, 10, 'Nostrum illo in ipsum iusto. Quaerat ut quo fugit laudantium eos esse. Libero veritatis quaerat ea quaerat consectetur. Non officiis quo minus eaque in autem.', '', '', '2021-10-08 18:05:06', NULL),
('7ba51261-8d09-452c-939c-9e3743aa8c61', NULL, 'Practical Silk Bag', 'practical-silk-bag', 414, 21, 0, 2, 10, 'Aut ratione quidem consequatur fugiat nihil. Odit nobis in iste impedit rerum quaerat dolor. Sint rerum pariatur eius voluptatem. Molestias sunt modi cumque amet corrupti.', '', '', '2021-10-08 18:05:06', NULL),
('7d986836-d4e2-489f-8600-502f5fd027c7', NULL, 'Durable Granite Table', 'durable-granite-table', 1420, 7, 0, 6, 10, 'Non explicabo quia dicta repellat itaque. Aliquid ut sequi aut. Sunt ut esse dicta vero velit molestiae vero quisquam.', '', '', '2021-10-08 18:05:06', NULL),
('80fac375-f318-420c-9d35-0822cfad5685', NULL, 'Small Copper Watch', 'small-copper-watch', 625, 13, 1, 4, 10, 'Corporis voluptate assumenda odio maiores quam. Vitae sequi voluptates quo voluptate sint reiciendis. Adipisci aperiam enim sunt ad quos id molestias.', '', '', '2021-10-08 18:05:06', NULL),
('828f05a2-c61e-479c-b7e2-bf2bed475247', NULL, 'Sleek Linen Shirt', 'sleek-linen-shirt', 340, 6, 1, 4, 10, 'Totam doloribus culpa unde nesciunt dolor. A quisquam qui aliquid culpa voluptatum error eius nam. Amet quaerat ut nemo harum aut facere.', '', '', '2021-10-08 18:05:06', NULL),
('8445c042-76c0-4a3c-bb06-ddcd0975bf9b', NULL, 'Rustic Marble Watch', 'rustic-marble-watch', 299, 22, 0, 5, 10, 'Omnis fuga soluta voluptatem similique optio nulla nihil. Dolores sed labore enim omnis quia qui. Possimus eum nihil velit eos voluptatem enim. Et facilis suscipit rerum et repudiandae.', '', '', '2021-10-08 18:05:06', NULL),
('86e01cb1-53ac-4814-a148-de3464e5bc0c', NULL, 'Rustic Copper Watch', 'rustic-copper-watch', 228, 5, 0, 5, 10, 'Deserunt ea alias quia sequi. Sunt necessitatibus nostrum aut. Suscipit eius et illo odit minima sequi natus ratione. Illo architecto et ut eveniet libero eum aliquid.', '', '', '2021-10-08 18:05:06', NULL),
('89efbdc7-af6e-440d-81ca-299931ea3600', NULL, 'Aerodynamic Silk Bottle', 'aerodynamic-silk-bottle', 1724, 46, 0, 4, 10, 'Quod sed ipsa doloremque in odio. Voluptatum et quos itaque et. Est nesciunt velit consequatur hic accusantium distinctio dolorem.', '', '', '2021-10-08 18:05:06', NULL),
('995e5d30-8647-4ead-9a30-a070716ef178', NULL, 'Mediocre Wooden Bag', 'mediocre-wooden-bag', 1205, 5, 0, 6, 10, 'Quidem corrupti qui magni ex. Et adipisci dolorem qui praesentium nihil. Qui asperiores velit sit nihil hic excepturi.', '', '', '2021-10-08 18:05:06', NULL),
('9c41e603-e820-46ed-b3f9-8cde989a9214', NULL, 'Small Leather Knife', 'small-leather-knife', 364, 31, 1, 5, 10, 'Iusto animi consequatur fugit adipisci fuga aspernatur distinctio. Illum autem est id voluptatibus sint. Rerum est sequi inventore.', '', '', '2021-10-08 18:05:06', NULL),
('9ddcb0a4-b6ed-4986-914d-e8874b707d14', NULL, 'Awesome Bronze Computer', 'awesome-bronze-computer', 1800, 29, 0, 5, 10, 'Enim enim animi reprehenderit sint. Ea est corrupti tempore similique consequuntur laboriosam. Dignissimos soluta omnis natus quia.', '', '', '2021-10-08 18:05:06', NULL),
('ac890b97-5d4e-45a3-b7ee-ec1f22592fa9', NULL, 'Ergonomic Copper Bag', 'ergonomic-copper-bag', 538, 41, 1, 6, 10, 'Optio omnis dolores id esse. Beatae eius aspernatur est commodi. Neque inventore inventore ducimus autem ea magni accusantium. Sequi rem reprehenderit delectus. Vero numquam aut repellendus.', '', '', '2021-10-08 18:05:06', NULL),
('af0d5a53-ea3a-4ff0-b152-cf2c9e3b9498', NULL, 'Sleek Iron Car', 'sleek-iron-car', 1453, 39, 1, 2, 10, 'Saepe quis neque id aspernatur a. Quis ab voluptatem mollitia rem voluptate odio. Est voluptatem ut vel et sit sunt aut. Commodi et consequatur quia debitis dolor. Incidunt ea quam non eum.', '', '', '2021-10-08 18:05:06', NULL),
('bde51636-8a5b-45eb-8ee2-b73a10c457d8', NULL, 'Fantastic Rubber Gloves', 'fantastic-rubber-gloves', 909, 45, 0, 2, 10, 'Est accusantium placeat deserunt. Dolor iure corporis nulla repellat. Qui saepe ipsam minima deleniti iure porro impedit aut. Deserunt sit vitae eligendi omnis ex tempore aut et.', '', '', '2021-10-08 18:05:06', NULL),
('be70e92c-0bb5-4546-a5b0-b508e2da3b0c', NULL, 'Synergistic Wool Wallet', 'synergistic-wool-wallet', 757, 11, 0, 3, 10, 'Numquam fugiat perferendis assumenda rerum rerum recusandae. Vero doloribus odio nihil iusto hic. Et neque accusantium dolore id quod illo nam.', '', '', '2021-10-08 18:05:06', NULL),
('c068d3d9-38a1-4409-bef1-065f30e66c61', NULL, 'Synergistic Rubber Hat', 'synergistic-rubber-hat', 1026, 35, 0, 6, 10, 'Laboriosam assumenda porro libero reprehenderit. Repellendus et voluptatum eum tempore aperiam sit aut. Odit non et laborum nobis incidunt dicta dolor non. Non iusto quas earum.', '', '', '2021-10-08 18:05:06', NULL),
('c70fcb7d-9419-42a8-b0df-778082fb5a68', NULL, 'Small Marble Pants', 'small-marble-pants', 210, 44, 0, 2, 10, 'Eligendi consequatur rem in quos. Eum aut optio omnis officia sit distinctio aut explicabo. Possimus odit animi dicta.', '', '', '2021-10-08 18:05:06', NULL),
('c972723c-13f6-4d7c-ae27-392d856b3b3c', NULL, 'Small Leather Car', 'small-leather-car', 729, 29, 1, 3, 10, 'Et quis mollitia et. Eum dolores in dolor dolorem quis quam ut. Vel ipsa et veniam non doloremque.', '', '', '2021-10-08 18:05:06', NULL),
('cea3674b-1dc1-4d95-b8f8-1b5d6088f23e', NULL, 'Heavy Duty Iron Hat', 'heavy-duty-iron-hat', 1553, 38, 0, 5, 10, 'Excepturi neque odit ratione amet quidem ut. Dolor nobis libero vel minima quia nulla quae. Velit non itaque consequatur dolorum dolorem libero.', '', '', '2021-10-08 18:05:06', NULL),
('d94f661c-2f19-4091-900c-14f84d25268a', NULL, 'Aerodynamic Plastic Table', 'aerodynamic-plastic-table', 1832, 22, 1, 4, 10, 'Non sequi culpa corporis reprehenderit. Impedit et hic est ea veniam numquam esse. Minima soluta est explicabo rerum adipisci consequatur ab.', '', '', '2021-10-08 18:05:06', NULL),
('dc3d72d3-79b9-456e-8177-32e4563aecbe', NULL, 'Sleek Marble Table', 'sleek-marble-table', 1826, 39, 1, 5, 10, 'Aut dolorem molestiae aut similique quaerat tenetur. Qui quo aliquam repellat qui. Debitis laborum maiores nam nobis.', '', '', '2021-10-08 18:05:06', NULL),
('de88e568-eb94-4cdb-bcde-b4f1cba9d244', NULL, 'Intelligent Marble Computer', 'intelligent-marble-computer', 1954, 23, 0, 3, 10, 'Tempore culpa blanditiis accusamus voluptatum explicabo ut. Voluptatem repellat dicta at accusantium nihil harum.', '', '', '2021-10-08 18:05:06', NULL),
('e0ab3720-20e7-4222-8d7b-a2cea76e6aaa', NULL, 'Awesome Paper Gloves', 'awesome-paper-gloves', 135, 12, 0, 4, 10, 'Sed porro repudiandae reiciendis quibusdam ut ullam. Sit qui sit et nesciunt et aut. Hic officia magni officia eaque ut. Molestiae in tempora pariatur est aliquid quas aut.', '', '', '2021-10-08 18:05:06', NULL),
('e1ef66b5-4238-4868-84b5-ee5ec75b3238', NULL, 'Aerodynamic Wool Plate', 'aerodynamic-wool-plate', 76, 11, 1, 4, 10, 'Est repellat voluptatem in id dolores et odio. Exercitationem distinctio officia suscipit ab. Fugiat quas quia id est.', '', '', '2021-10-08 18:05:06', NULL),
('eca325e7-af9b-414f-bae5-f08cc1971690', NULL, 'Rustic Cotton Chair', 'rustic-cotton-chair', 734, 37, 1, 3, 10, 'Harum enim ut harum et debitis sit. Consequatur dolores voluptate nulla magnam occaecati nam. Aliquam assumenda inventore voluptatem quis quia saepe.', '', '', '2021-10-08 18:05:06', NULL),
('f34268e5-6ef1-434c-9281-d64c38c984c6', NULL, 'Sleek Silk Gloves', 'sleek-silk-gloves', 1495, 40, 0, 2, 10, 'Voluptatem autem ratione hic nihil eligendi. Dolore dolores autem voluptatum porro consequuntur ullam. Neque odit voluptatem ut quod. A qui sit ut sapiente fugit ullam veniam. Sequi nemo aliquid ut.', '', '', '2021-10-08 18:05:06', NULL),
('f83de98e-8715-495c-8325-823cf31bad82', NULL, 'Incredible Plastic Pants', 'incredible-plastic-pants', 1476, 8, 1, 6, 10, 'Cupiditate temporibus nobis tenetur delectus. Debitis voluptatem dignissimos voluptas quaerat. Sed quia itaque repudiandae qui rerum error. Error quae doloribus minima saepe eaque ullam.', '', '', '2021-10-08 18:05:06', NULL),
('fe72f30b-fbfb-48a5-ac9f-9e9a685b143a', NULL, 'Durable Silk Watch', 'durable-silk-watch', 1890, 26, 1, 2, 10, 'Explicabo reiciendis quia temporibus sed soluta sed et. Et et et adipisci at. Et ullam commodi debitis totam. Repellendus deleniti alias maxime sit sint corrupti.', '', '', '2021-10-08 18:05:06', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `product_attachment`
--

CREATE TABLE `product_attachment` (
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `attachment_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `range_value`
--

CREATE TABLE `range_value` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `max` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `range_value`
--

INSERT INTO `range_value` (`id`, `max`) VALUES
('23dc7e10-d1b9-4d1d-8140-42f2c44a5dd2', 49.82),
('39517b6f-af9e-4313-89a7-1d416bb54359', 15.59),
('523dddd4-23d7-4db4-99b4-0396c05157ab', 40.16),
('8bbd4480-2921-44f2-82e3-89448835f928', 10.04),
('9bfa2c68-a891-4b7a-a7fa-129e2793dd06', 32.79),
('c5462749-f519-41f0-8e79-4f973b7afefc', 23.89);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

CREATE TABLE `review` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `author_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `rating` int(11) NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'PENDING',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `setting`
--

CREATE TABLE `setting` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `key_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `shop`
--

CREATE TABLE `shop` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_infos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_shipping` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_invoice` tinyint(1) NOT NULL DEFAULT '1',
  `has_card` tinyint(1) NOT NULL DEFAULT '1',
  `has_transfer` tinyint(1) NOT NULL DEFAULT '1',
  `has_check` tinyint(1) NOT NULL DEFAULT '1',
  `has_mandat` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `shop`
--

INSERT INTO `shop` (`id`, `name`, `address`, `holder`, `email`, `bic`, `iban`, `bank`, `bank_address`, `phone`, `facebook`, `home`, `home_infos`, `home_shipping`, `has_invoice`, `has_card`, `has_transfer`, `has_check`, `has_mandat`, `created_at`, `updated_at`) VALUES
('8d5c9e9e-84f0-43f3-b936-046b8ea0b64a', 'Est animi quaerat.', '4335 Baron Meadow Suite 041\nGreenholtbury, SD 54580-1899', 'SENTENCE(3)', 'runte.marisol@yahoo.com', '645sfd58fl1vd4ss', 'SK9360058873829929969021', 'Ut commodi sed.', '763 Becker Curve Suite 115\nEast Ruthefort, WV 91650', '(508) 499-6637', 'http://www.beer.com/ullam-dolor-debitis-quo-saepe-vel.html', 'Est labore et.', 'Et odit molestiae tempora aut. Quam dignissimos adipisci rerum beatae laboriosam possimus. Voluptatibus et maiores ex ratione facilis consequatur est.', 'Eius et non autem. Praesentium at porro aut corporis quis in. Asperiores sed sit eum vero. Nihil harum sit et nemo rerum quasi.', 1, 1, 1, 1, 1, NULL, NULL),
('f35f0bb0-8917-4f92-9d5d-24acdf5da407', 'Atque qui.', '6604 Rogers Mount Suite 814\nSteuberton, OH 80172', 'SENTENCE(3)', 'timothy.yost@yahoo.com', 'd5v14fd4fs685sls', 'IL145734431409352258624', 'Dolores harum cumque.', '868 Auer Haven\nNew Robin, ID 88309-1511', '+1 (806) 608-4060', 'http://hudson.com/molestias-qui-expedita-delectus-accusamus.html', 'Qui animi.', 'Deleniti illo blanditiis eum quia illum et pariatur. Animi quas laboriosam nisi sed. Placeat accusantium repudiandae nesciunt labore dolores iusto dolor est.', 'Non aut itaque eius. Delectus aspernatur maiores atque quam unde. Voluptates et eaque praesentium nam consequatur incidunt. Quasi placeat amet veniam sit.', 1, 1, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `state`
--

CREATE TABLE `state` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `state`
--

INSERT INTO `state` (`id`, `name`, `slug`, `color`, `indice`) VALUES
('0b1197f3-f35f-4a29-b6dc-3de591aee12e', 'Attente virement', 'virement', 'blue', 1),
('0b72db5c-facf-42ac-813f-97ca6923cba0', 'cancelled', 'cancelled', 'green', 6),
('0f7e8d6d-03f7-4594-b3dd-5f1becc85ee3', 'Expédié', 'expedie', 'green', 5),
('117bfbd7-1068-4e02-92a0-ced4aac189e8', 'Attente paiement par carte', 'cart', 'blue', 1),
('17cf11f0-69b9-4ce5-bfa9-9ab99cc50752', 'shipped', 'shipped', 'green', 6),
('1eb23a42-36f0-46fb-9795-92b6d50d2f95', 'payment_selected', 'payment-selected', 'green', 6),
('2639d7b4-1681-486a-9c32-f6cd16364558', 'Paiement accepté', 'paiement-ok', 'green', 4),
('31ced6ae-973f-47e2-a474-5f4877e83157', 'awaiting_payment', 'awaiting-payment', 'yellow', 7),
('3de7cf5a-b962-4d57-9636-7cd70fab7a1d', 'Remboursé', 'rembourse', 'red', 6),
('7bda8a10-7ca6-47d2-b370-4d6b743e80ad', 'paid', 'paid', 'green', 6),
('81821cda-f572-448c-a732-570a0c5d6d96', 'completed', 'completed', 'red', 6),
('a9d8acff-afdb-4819-93cd-73c3f918064f', 'fulfilled', 'fulfilled', 'green', 6),
('b07fedc5-5bd6-48f7-9c01-914afb3bd31f', 'addressed', 'addressed', 'yellow', 6),
('b97f60b8-6357-430c-ac07-4ee785a6be37', 'Attente chèque', 'cheque', 'blue', 1),
('c721bee3-e067-452a-a4ed-e0fc339678f4', 'Mandat administratif reçu', 'mandat-ok', 'green', 3),
('d0d63800-263a-4984-b1f5-b7f0744620ea', 'Erreur de paiement', 'error', 'red', 2),
('d79f8410-d9d5-46bd-8160-1ec049e4bacb', 'Attente mandat administratif', 'mandat', 'blue', 1),
('db09178d-a7ba-4e92-af7a-0acf2f6983d2', 'new', 'new', 'blue', 6),
('e04fed3e-91e0-4162-ba7b-4940e2808426', 'shipping_selected', 'shipping-selected', 'red', 6),
('e48d78a8-6b6e-40b5-b1db-65c9a1fe0d9a', 'ready', 'ready', 'red', 6);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `image_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `last_seen` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `image_id`, `email`, `username`, `roles`, `password`, `is_verified`, `newsletter`, `last_seen`, `created_at`, `updated_at`) VALUES
('0041ce09-a9d8-4c8c-8c70-fe6330675696', NULL, 'herminia.hahn@gmail.com', 'erna39', '[]', '$argon2id$v=19$m=65536,t=4,p=1$aGJNOVo2S2tYaVRJdHNlMA$bf1VpegSGVzLjLcPzVTB68XW2zQpvrYrrn/2rk7rQfU', 1, 1, '2021-02-27 09:36:58', '2021-10-08 18:05:01', NULL),
('03b14e1c-78aa-42b1-b43e-71971cebfb01', NULL, 'zcummings@gmail.com', 'xstreich', '[]', '$argon2id$v=19$m=65536,t=4,p=1$dE5ZUkI1YW1ZSGpDZUk0UQ$N/knwpSq4PI6MKiaSMKGraX44C770Na2H2FzVPD0rg8', 1, 0, '2021-01-17 15:11:08', '2021-10-08 18:05:03', NULL),
('258b837c-bf48-4978-87a8-962afa5ea5af', NULL, 'aletha.flatley@muller.org', 'ephraim21', '[]', '$argon2id$v=19$m=65536,t=4,p=1$RTEwd1R5UEpaSE5ScUd5Qw$XkHbH4AwCe9IH4osCISvKw3t8IKLn7LoBxISmgWnr5w', 1, 0, '2021-07-30 01:12:08', '2021-10-08 18:05:04', NULL),
('41fd5df8-1a5f-4acb-a9c8-bb6f257955e2', NULL, 'phenixibm@gmail.com', 'phenix', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$U3o0bktNNEpIcXRiV01SUQ$BuDPfpaCXELUIEJRUcMkqPX+aTyArsMWeDJbcDYvimQ', 1, 0, '2021-10-08 18:31:53', '2021-10-08 18:05:06', '2021-10-08 18:31:54'),
('a7b6c71d-88c5-4fdc-ace8-0c07ac3f595d', NULL, 'obins@ledner.com', 'jackeline78', '[]', '$argon2id$v=19$m=65536,t=4,p=1$UFJxUzQvNUU3Uk4uSXFvSw$y+WiWnHFqhPyPCUEsWox87dexhNFOvEJj1AHRkVl0oY', 1, 1, '2021-03-24 10:23:47', '2021-10-08 18:05:05', NULL),
('b1d881ed-860b-4782-a212-eeb173236d35', NULL, 'letha.koepp@hotmail.com', 'osinski.heath', '[]', '$argon2id$v=19$m=65536,t=4,p=1$dkhtckRNNUIyLlEySkIwbw$KW9e+s38FOTbqiqxWgWQffDkvMkMItrUCCENtw5OiJk', 1, 0, '2021-03-23 07:32:54', '2021-10-08 18:05:04', NULL),
('bac66468-9d3f-4340-9219-4a625e689f46', NULL, 'tsteuber@hotmail.com', 'zetta86', '[]', '$argon2id$v=19$m=65536,t=4,p=1$cjVkMUl3amVZcllPT1lhRg$rx6sYJMjZX5eN8YpKxSIFfibqJcLVEW7KXZxi2sPzkQ', 1, 1, '2021-02-22 07:02:12', '2021-10-08 18:04:59', NULL),
('c98da828-02f1-48ae-8e6f-71a2631de351', NULL, 'rubye.will@yahoo.com', 'kennedy05', '[]', '$argon2id$v=19$m=65536,t=4,p=1$bVhvdGQ4aWRNUFd1WVZwaQ$dmolgmUQzK57cjzaU+5OcNmskz7JYWw+zHu1xdOTs7c', 1, 1, '2021-03-27 05:16:10', '2021-10-08 18:05:06', NULL),
('d3f92001-95ff-4043-8642-0be2ef840199', NULL, 'boehm.theo@gmail.com', 'rau.camden', '[]', '$argon2id$v=19$m=65536,t=4,p=1$VTEwbWpPYW4vdGhEdWo0dQ$WlituEW4JzOgF1K2AhCl6V8hqBRbwgj/Z1DObtiO3nU', 1, 1, '2021-03-16 13:16:31', '2021-10-08 18:05:05', NULL),
('eba1fd9f-a817-4efd-8406-bc81490b1074', NULL, 'rdooley@gmail.com', 'ffadel', '[]', '$argon2id$v=19$m=65536,t=4,p=1$cWVtSHNub0FCM3ZGL3JSMg$fKzYuLs5RAV1irw+e0Ia9rCLBHdmmnK2tnnfcNmuyQM', 1, 1, '2021-05-26 11:21:17', '2021-10-08 18:05:02', NULL),
('ebfe77c7-7a90-45ed-b2f1-baf63b9095ec', NULL, 'heloise.littel@kiehn.com', 'nikki97', '[]', '$argon2id$v=19$m=65536,t=4,p=1$RWlqVjdXM0dsTUFTazlqTw$D/8K9HFJPJrtmAv/lhsiomNJfwPvKbI4q6Pp4P06YrY', 1, 1, '2021-09-21 15:55:15', '2021-10-08 18:05:02', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D4E6F81F92F3E70` (`country_id`),
  ADD KEY `IDX_D4E6F81A76ED395` (`user_id`);

--
-- Index pour la table `attachment`
--
ALTER TABLE `attachment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_64C19C15E237E06` (`name`),
  ADD UNIQUE KEY `UNIQ_64C19C1989D9B62` (`slug`),
  ADD KEY `IDX_64C19C1A977936C` (`tree_root`),
  ADD KEY `IDX_64C19C1727ACA70` (`parent_id`);

--
-- Index pour la table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`category_id`,`product_id`),
  ADD KEY `IDX_149244D312469DE2` (`category_id`),
  ADD KEY `IDX_149244D34584665A` (`product_id`);

--
-- Index pour la table `colissimo`
--
ALTER TABLE `colissimo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_64616F3AF92F3E70` (`country_id`),
  ADD KEY `IDX_64616F3AB7741401` (`range_value_id`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5373C966B7741401` (`range_value_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `gateway_config`
--
ALTER TABLE `gateway_config`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F5299398AEA34913` (`reference`),
  ADD UNIQUE KEY `UNIQ_F529939879D0C0E4` (`billing_address_id`),
  ADD UNIQUE KEY `UNIQ_F52993984D4CFF2B` (`shipping_address_id`),
  ADD KEY `IDX_F5299398A76ED395` (`user_id`),
  ADD KEY `IDX_F52993985D83CC1` (`state_id`);

--
-- Index pour la table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2530ADE68D9F6D38` (`order_id`),
  ADD KEY `IDX_2530ADE64584665A` (`product_id`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6D28840D8D9F6D38` (`order_id`),
  ADD KEY `IDX_6D28840D19883967` (`method_id`);

--
-- Index pour la table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7B61A1F6F23D6140` (`gateway_config_id`);

--
-- Index pour la table `payment_token`
--
ALTER TABLE `payment_token`
  ADD PRIMARY KEY (`hash`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D34A04AD5E237E06` (`name`),
  ADD UNIQUE KEY `UNIQ_D34A04AD989D9B62` (`slug`),
  ADD KEY `IDX_D34A04AD3DA5256D` (`image_id`);

--
-- Index pour la table `product_attachment`
--
ALTER TABLE `product_attachment`
  ADD PRIMARY KEY (`product_id`,`attachment_id`),
  ADD UNIQUE KEY `UNIQ_EA388690464E68B` (`attachment_id`),
  ADD KEY `IDX_EA3886904584665A` (`product_id`);

--
-- Index pour la table `range_value`
--
ALTER TABLE `range_value`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Index pour la table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_794381C64584665A` (`product_id`),
  ADD KEY `IDX_794381C6F675F31B` (`author_id`);

--
-- Index pour la table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_8D93D6493DA5256D` (`image_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FK_D4E6F81A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_D4E6F81F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FK_64C19C1727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_64C19C1A977936C` FOREIGN KEY (`tree_root`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `FK_149244D312469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_149244D34584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `colissimo`
--
ALTER TABLE `colissimo`
  ADD CONSTRAINT `FK_64616F3AB7741401` FOREIGN KEY (`range_value_id`) REFERENCES `range_value` (`id`),
  ADD CONSTRAINT `FK_64616F3AF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `country`
--
ALTER TABLE `country`
  ADD CONSTRAINT `FK_5373C966B7741401` FOREIGN KEY (`range_value_id`) REFERENCES `range_value` (`id`);

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F52993984D4CFF2B` FOREIGN KEY (`shipping_address_id`) REFERENCES `address` (`id`),
  ADD CONSTRAINT `FK_F52993985D83CC1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`),
  ADD CONSTRAINT `FK_F529939879D0C0E4` FOREIGN KEY (`billing_address_id`) REFERENCES `address` (`id`),
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `FK_2530ADE64584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_2530ADE68D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Contraintes pour la table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK_6D28840D19883967` FOREIGN KEY (`method_id`) REFERENCES `payment_method` (`id`),
  ADD CONSTRAINT `FK_6D28840D8D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Contraintes pour la table `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `FK_7B61A1F6F23D6140` FOREIGN KEY (`gateway_config_id`) REFERENCES `gateway_config` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `attachment` (`id`);

--
-- Contraintes pour la table `product_attachment`
--
ALTER TABLE `product_attachment`
  ADD CONSTRAINT `FK_EA3886904584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_EA388690464E68B` FOREIGN KEY (`attachment_id`) REFERENCES `attachment` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_794381C64584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_794381C6F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6493DA5256D` FOREIGN KEY (`image_id`) REFERENCES `attachment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
