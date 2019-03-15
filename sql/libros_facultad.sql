
CREATE TABLE `libros_facultad` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `author_name` varchar(500) NOT NULL,
  `price` varchar(500) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;


INSERT INTO `libros_facultad` (`id`, `title`, `author_name`, `price`, `isbn`, `category`) VALUES
(1, 'C++ By Example', 'John', '500', 'PR-123-A1', 'Programming'),
(2, 'Java Book', 'Jane davis', '450', 'PR-456-A2', 'Programming'),
(3, 'Database Management Systems', 'Mark', '$75', 'DB-123-ASD', 'Database'),
(4, 'Python', 'J.K. Rowling', '650', 'FC-123-456', 'Novel'),
(5, 'Data Structures', 'author 5', '450', 'FC-456-678', 'Programming'),
(6, 'Learning Web Development ', 'Michael', '300', 'ABC-123-456', 'Web Development'),
(7, 'Professional PHP & MYSQL', 'Programmer Blog', '$340', 'PR-123-456', 'Web Development'),
(8, 'Java Server Pages', 'technical authoer', ' $45.90', 'ABC-567-345', 'Programming'),
(9, 'Marketing', 'author3', '$423.87', '456-GHI-987', 'Business'),
(10, 'Economics', 'autor9', '$45', '234-DSG-456', 'Business');


ALTER TABLE `libros_facultad`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `libros_facultad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;

