-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 19, 2023 at 08:08 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `top_indian_movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentarios` int(11) NOT NULL,
  `comentario` mediumtext NOT NULL,
  `data_insercao` datetime NOT NULL DEFAULT current_timestamp(),
  `ref_filmes` int(11) NOT NULL,
  `ref_utilizadores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filmes`
--

CREATE TABLE `filmes` (
  `id_filmes` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `ano` year(4) NOT NULL,
  `sinopse` text NOT NULL,
  `url_imdb` varchar(250) DEFAULT NULL,
  `url_trailer` varchar(250) DEFAULT NULL,
  `ref_generos` int(11) NOT NULL,
  `data_insercao` datetime NOT NULL DEFAULT current_timestamp(),
  `ref_utilizadores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `filmes`
--

INSERT INTO `filmes` (`id_filmes`, `titulo`, `ano`, `sinopse`, `url_imdb`, `url_trailer`, `ref_generos`, `data_insercao`, `ref_utilizadores`) VALUES
(1, 'Ramayana: The Legend of Prince Rama', 1993, 'The fantastic story of Rama, a young prince who has been banished to the forest by his stepmother. He is under the protection of his wife Sita and his brother Lakshman. When a powerful demon king Ravan abducts Sita, Rama reduces into tears and sorrow but he stays strong and fights. He must fight warrior demons, control his sorrow and fight until his wife is free.', 'https://m.imdb.com/title/tt0259534/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=690bec67-3bd7-45a1-9ab4-4f274a72e602&pf_rd_r=GWD6Z6F24JJ7SNNQGHD9&pf_rd_s=center-4&pf_rd_t=60601&pf_rd_i=india.top-rated-indian-movies&ref_=m_fea_india_ss_toprated_tt_1', 'https://m.imdb.com/video/vi2696398105/?ref_=tt_vi_i_1', 1, '2023-03-19 19:03:57', 1),
(2, 'Rocketry: The Nambi Effect', 2022, 'Based on the life of Indian Space Research Organization scientist Nambi Narayanan, who was framed for being a spy and arrested in 1994. Though free, he continues to fight for justice against the officials who falsely implicated him.', 'https://m.imdb.com/title/tt9263550/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=690bec67-3bd7-45a1-9ab4-4f274a72e602&pf_rd_r=GWD6Z6F24JJ7SNNQGHD9&pf_rd_s=center-4&pf_rd_t=60601&pf_rd_i=india.top-rated-indian-movies&ref_=m_fea_india_ss_toprated_tt_2', 'https://m.imdb.com/video/vi3653812761/?playlistId=tt9263550&ref_=tt_pr_ov_vi', 8, '2023-03-19 19:03:57', 1),
(3, 'Nayakan', 1987, 'Sakthivel, son of a union leader, stabs a policeman who killed his father and runs away to Mumbai slum. When he grows up, he kills an inspector, Kelkar who tortures the people. Thus he becomes the protector and Mumbai mafia don. He marries a prostitute, Neela and they get two children. In the end, he is arrested and acquitted but is shot dead by Ajit, son of Kelkar. ', 'https://m.imdb.com/title/tt0093603/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=690bec67-3bd7-45a1-9ab4-4f274a72e602&pf_rd_r=GWD6Z6F24JJ7SNNQGHD9&pf_rd_s=center-4&pf_rd_t=60601&pf_rd_i=india.top-rated-indian-movies&ref_=m_fea_india_ss_toprated_tt_3', 'https://m.imdb.com/video/vi155499289/?playlistId=tt0093603&ref_=tt_pr_ov_vi', 4, '2023-03-19 19:03:57', 1),
(4, 'Gol Maal', 1979, 'Ramprasad is a recent college graduate who finds a job with a finicky man, Bhavani Shankar, who believes that a man without a mustache is a man without a character. Bhavani Shankar is also against any of his employees indulging in recreation of any kind. When Ramprasad\'s boss catches him at a hockey match, he invents a twin brother, the clean-shaven Laxman Prasad, to save his job. When Bhavani\'s daughter falls in love with the clean-shaven Laxman Prasad and insists on marrying him, and Bhavani insists she should marry Ramprasad, things take a wacky turn. A fake mother and a hilarious chase are other enjoyable features involved in this comedy. ', 'https://m.imdb.com/title/tt0079221/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=690bec67-3bd7-45a1-9ab4-4f274a72e602&pf_rd_r=GWD6Z6F24JJ7SNNQGHD9&pf_rd_s=center-4&pf_rd_t=60601&pf_rd_i=india.top-rated-indian-movies&ref_=m_fea_india_ss_toprated_tt_4', 'https://m.imdb.com/video/vi1489026841/?playlistId=tt0079221&ref_=tt_pr_ov_vi', 3, '2023-03-19 19:03:57', 1),
(5, 'Anbe Sivam', 2003, 'Evocative and provocative, this masterfully crafted relationship drama tells the story of a series of comic events that occur when Nalla Sivam (Kamal Haasan) a wise-cracking, handicapped communist and Anbarasu (R. Madhavan), an arrogant young advertisement filmmaker who favors capitalism meet. They get stuck with each other on their problem-filled trip from Bhubaneswar to Chennai, giving them a unique opportunity to explore each other\'s belief system. Themes such as globalization, financial disparity and compassion in present-day India are explored around the two protagonists, while they also find how deeply interconnected their lives are.', 'https://m.imdb.com/title/tt0367495/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=690bec67-3bd7-45a1-9ab4-4f274a72e602&pf_rd_r=GWD6Z6F24JJ7SNNQGHD9&pf_rd_s=center-4&pf_rd_t=60601&pf_rd_i=india.top-rated-indian-movies&ref_=m_fea_india_ss_toprated_tt_5', 'https://m.imdb.com/video/vi2824911641/?playlistId=tt0367495&ref_=tt_ov_vi', 9, '2023-03-19 19:03:57', 1),
(6, '777 Charlie', 2022, 'The protagonist is stuck in a rut with his negative and lonely lifestyle and spends each day in the comfort of his loneliness. A pup named Charlie who is naughty and energetic which makes him complete contrast with the protagonists\' character enters his life and gives him a new perspective towards it.', 'https://m.imdb.com/title/tt7466810/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=690bec67-3bd7-45a1-9ab4-4f274a72e602&pf_rd_r=GWD6Z6F24JJ7SNNQGHD9&pf_rd_s=center-4&pf_rd_t=60601&pf_rd_i=india.top-rated-indian-movies&ref_=m_fea_india_ss_toprated_tt_6', 'https://m.imdb.com/video/vi3431842329/?playlistId=tt7466810&ref_=tt_pr_ov_vi', 9, '2023-03-19 19:03:57', 1),
(7, 'Pariyerum Perumal', 2018, 'A law student from a lower caste begins a friendship with his classmate, a girl who belongs to a higher caste, and the men in her family start giving him trouble over this.', 'https://m.imdb.com/title/tt8176054/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=690bec67-3bd7-45a1-9ab4-4f274a72e602&pf_rd_r=GWD6Z6F24JJ7SNNQGHD9&pf_rd_s=center-4&pf_rd_t=60601&pf_rd_i=india.top-rated-indian-movies&ref_=m_fea_india_ss_toprated_tt_7', 'https://m.imdb.com/video/vi3544235033/?playlistId=tt8176054&ref_=tt_pr_ov_vi', 4, '2023-03-19 19:03:57', 1),
(8, 'Jai Bhim', 2021, 'Rajakannu and his wife Sengeni belong to a lower cast and works as labors in the field to protect it from rats thou they live life of poverty but are happy with what they have. Rajakannu and Sengeni plan a second child and soon Sengeni gives the good news once Rajkannu is called to the house of a upper caste man as a snake has sneaked inside his house.The next day theft of jewelry is reported in the same house suspicious raising towards Rajkannu .The cops got to arrest Rajkannu but he leaves the town for work following which the cops detain a pregnant Sengani and rest of family members asking them details about the Rajkannu.The cops trace Rajkannu and torture him and his brothers in jail asking him to confess the crime they did not commit later Sengeni finds that Rajkannu and his brother have eloped from the prison to escape torture.Mythra who teaches tribal village comes across a lawyer Chandru who fights for tribal people and after hearing story of Senegeni files a Habeas corpus case in court.', 'https://m.imdb.com/title/tt15097216/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=690bec67-3bd7-45a1-9ab4-4f274a72e602&pf_rd_r=GWD6Z6F24JJ7SNNQGHD9&pf_rd_s=center-4&pf_rd_t=60601&pf_rd_i=india.top-rated-indian-movies&ref_=m_fea_india_ss_toprated_tt_8', 'https://m.imdb.com/video/vi713802521/?playlistId=tt15097216&ref_=tt_pr_ov_vi', 10, '2023-03-19 19:03:57', 1),
(9, '3 Idiots', 2009, 'Racho is an engineering student. His two friends. Farhan and Raju, Racho sees the world in a different way. Racho goes somewhere one day. And his friends find him. When Racho is found, it becomes a one of a great scientist in the world. ', 'https://m.imdb.com/title/tt1187043/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=690bec67-3bd7-45a1-9ab4-4f274a72e602&pf_rd_r=GWD6Z6F24JJ7SNNQGHD9&pf_rd_s=center-4&pf_rd_t=60601&pf_rd_i=india.top-rated-indian-movies&ref_=m_fea_india_ss_toprated_tt_9', 'https://m.imdb.com/video/vi3086596889/?playlistId=tt1187043&ref_=tt_pr_ov_vi', 3, '2023-03-19 19:03:57', 1),
(10, 'Apur Sansar', 1959, 'Liberated from any form of attachment that was holding him back from immersing himself into Kolkata\'s urban lifestyle after Sarbojaya\'s death in O Invicto (1956), Apu, now an optimistic, 23-year-old idealist and struggling author, has no other choice but to give up his degree for lack of financial resources. Being no longer accountable to anyone, Apu barely manages to scrape by, content with a meagre income and a humble roof over his head, until an unforeseen complication during the wedding of Aparna, the delicate sister of his university friend, Pulu, leads to an act of kindness and a wonderful, youthful romance. All his life, death, and the sense of loss, have been accompanying Apu in his perpetual odyssey of spirituality and knowledge; now, a lifetime of joys, hopes, sadness, and tragedies culminate in the most momentous decision of his life. But, life\'s mysterious duality cannot be defined by tragedy. What more could one ask for than a child\'s charming, wide-eyed smile?', 'https://m.imdb.com/title/tt0052572/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=690bec67-3bd7-45a1-9ab4-4f274a72e602&pf_rd_r=GWD6Z6F24JJ7SNNQGHD9&pf_rd_s=center-4&pf_rd_t=60601&pf_rd_i=india.top-rated-indian-movies&ref_=m_fea_india_ss_toprated_tt_10', 'https://m.imdb.com/video/vi3114774553/?playlistId=tt0052572&ref_=tt_pr_ov_vi', 4, '2023-03-19 19:03:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `filmes_favoritos`
--

CREATE TABLE `filmes_favoritos` (
  `ref_utilizadores` int(11) NOT NULL,
  `ref_filmes` int(11) NOT NULL,
  `data_insercao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filmes_votacao`
--

CREATE TABLE `filmes_votacao` (
  `ref_utilizadores` int(11) NOT NULL,
  `ref_filmes` int(11) NOT NULL,
  `votacao` tinyint(3) UNSIGNED NOT NULL COMMENT 'valores entre 1 e 10',
  `data_insercao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `generos`
--

CREATE TABLE `generos` (
  `id_generos` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `data_insercao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `generos`
--

INSERT INTO `generos` (`id_generos`, `tipo`, `data_insercao`) VALUES
(1, 'Animação', '2023-03-19 19:03:57'),
(2, 'Acção', '2023-03-19 19:03:57'),
(3, 'Comédia', '2023-03-19 19:03:57'),
(4, 'Drama', '2023-03-19 19:03:57'),
(5, 'Terror', '2023-03-19 19:03:57'),
(6, 'Musical', '2023-03-19 19:03:57'),
(7, 'Suspense', '2023-03-19 19:03:57'),
(8, 'Biografia', '2023-03-19 19:03:57'),
(9, 'Aventura', '2023-03-19 19:03:57'),
(10, 'Crime', '2023-03-19 19:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `perfis`
--

CREATE TABLE `perfis` (
  `id_perfis` int(11) NOT NULL,
  `perfil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perfis`
--

INSERT INTO `perfis` (`id_perfis`, `perfil`) VALUES
(1, 'administrador'),
(3, 'moderador'),
(2, 'registado');

-- --------------------------------------------------------

--
-- Table structure for table `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id_utilizadores` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `registo_confirmado` tinyint(4) NOT NULL DEFAULT 0,
  `data_insercao` datetime NOT NULL DEFAULT current_timestamp(),
  `ref_perfis` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `utilizadores`
--

INSERT INTO `utilizadores` (`id_utilizadores`, `nome`, `email`, `login`, `password_hash`, `registo_confirmado`, `data_insercao`, `ref_perfis`) VALUES
(1, 'test user', 'test_user', 'test_user@test.in', '1160130875fda0812c99c5e3f1a03516471a6370c4f97129b221938eb4763e63', 1, '2023-03-19 19:03:57', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentarios`),
  ADD KEY `fk_comentarios_filmes1_idx` (`ref_filmes`),
  ADD KEY `fk_comentarios_utilizadores1_idx` (`ref_utilizadores`);

--
-- Indexes for table `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id_filmes`),
  ADD KEY `fk_filmes_generos1_idx` (`ref_generos`),
  ADD KEY `fk_filmes_utilizadores1_idx` (`ref_utilizadores`);

--
-- Indexes for table `filmes_favoritos`
--
ALTER TABLE `filmes_favoritos`
  ADD PRIMARY KEY (`ref_utilizadores`,`ref_filmes`),
  ADD KEY `fk_utilizadores_has_filmes_filmes1_idx` (`ref_filmes`),
  ADD KEY `fk_utilizadores_has_filmes_utilizadores_idx` (`ref_utilizadores`);

--
-- Indexes for table `filmes_votacao`
--
ALTER TABLE `filmes_votacao`
  ADD PRIMARY KEY (`ref_utilizadores`,`ref_filmes`),
  ADD KEY `fk_utilizadores_has_filmes_filmes1_idx` (`ref_filmes`),
  ADD KEY `fk_utilizadores_has_filmes_utilizadores_idx` (`ref_utilizadores`);

--
-- Indexes for table `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_generos`),
  ADD UNIQUE KEY `tipo_UNIQUE` (`tipo`);

--
-- Indexes for table `perfis`
--
ALTER TABLE `perfis`
  ADD PRIMARY KEY (`id_perfis`),
  ADD UNIQUE KEY `perfil_UNIQUE` (`perfil`);

--
-- Indexes for table `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id_utilizadores`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_utilizadores_perfis1_idx` (`ref_perfis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id_filmes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `generos`
--
ALTER TABLE `generos`
  MODIFY `id_generos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `perfis`
--
ALTER TABLE `perfis`
  MODIFY `id_perfis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id_utilizadores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentarios_filmes1` FOREIGN KEY (`ref_filmes`) REFERENCES `filmes` (`id_filmes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comentarios_utilizadores1` FOREIGN KEY (`ref_utilizadores`) REFERENCES `utilizadores` (`id_utilizadores`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filmes`
--
ALTER TABLE `filmes`
  ADD CONSTRAINT `fk_filmes_generos1` FOREIGN KEY (`ref_generos`) REFERENCES `generos` (`id_generos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_filmes_utilizadores1` FOREIGN KEY (`ref_utilizadores`) REFERENCES `utilizadores` (`id_utilizadores`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filmes_favoritos`
--
ALTER TABLE `filmes_favoritos`
  ADD CONSTRAINT `fk_utilizadores_has_filmes_filmes1` FOREIGN KEY (`ref_filmes`) REFERENCES `filmes` (`id_filmes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_utilizadores_has_filmes_utilizadores` FOREIGN KEY (`ref_utilizadores`) REFERENCES `utilizadores` (`id_utilizadores`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filmes_votacao`
--
ALTER TABLE `filmes_votacao`
  ADD CONSTRAINT `fk_utilizadores_has_filmes_filmes10` FOREIGN KEY (`ref_filmes`) REFERENCES `filmes` (`id_filmes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_utilizadores_has_filmes_utilizadores0` FOREIGN KEY (`ref_utilizadores`) REFERENCES `utilizadores` (`id_utilizadores`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD CONSTRAINT `fk_utilizadores_perfis1` FOREIGN KEY (`ref_perfis`) REFERENCES `perfis` (`id_perfis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
