CREATE TABLE `analyst` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `rtbu_by_user_id` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `note` text NOT NULL,
  `created_at` date NOT NULL,
  `update_at` date NOT NULL
) 

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `version` int(11) DEFAULT NULL,
  `production_year` date DEFAULT NULL,
  `created_by_user_id` int(11) NOT NULL,
  `file_size` text NOT NULL,
  `duration` text DEFAULT NULL,
  `length` text DEFAULT NULL,
  `url` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `update_at` date DEFAULT NULL
)
CREATE TABLE `files` (
  `id` int(255) NOT NULL,
  `author` text NOT NULL,
  `judul` text NOT NULL,
  `file_type_id` text NOT NULL,
  `isi` text NOT NULL,
  `created_at` text DEFAULT NULL,
  `update_at` text DEFAULT NULL
)

CREATE TABLE `file_Type` (
  `id` int(255) NOT NULL,
  `jenis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `fullname` text NOT NULL,
  `created_at` text DEFAULT NULL,
  `update_at` text DEFAULT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) 

ALTER TABLE `analyst`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`);

ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`);

ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `file_Type`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `analyst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `files`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `analyst`
  ADD CONSTRAINT `analyst_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`);

ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`);
COMMIT;
