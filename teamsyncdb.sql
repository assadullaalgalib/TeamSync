-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2025 at 08:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teamsyncdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `task_id`, `user_id`, `comment`, `type`, `timestamp`) VALUES
(1, 1, 2, 'Started working on Task 1.', 'feedback', '2025-01-18 02:46:36'),
(2, 3, 7, 'Initial draft for Task 3 uploaded.', 'feedback', '2025-01-18 02:46:36'),
(3, 4, 3, 'Task 4 needs some revisions.', 'rejection', '2025-01-18 02:46:36'),
(4, 5, 4, 'Task 5 completed successfully.', 'approval', '2025-01-18 02:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `developer_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'Pending Approval'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `pm_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start_date` date DEFAULT NULL,
  `deadline` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending Approval',
  `type` varchar(50) NOT NULL DEFAULT 'Proposal',
  `comment` text DEFAULT NULL,
  `client_feedback` text DEFAULT NULL,
  `progress` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `client_id`, `pm_id`, `name`, `description`, `start_date`, `deadline`, `status`, `type`, `comment`, `client_feedback`, `progress`) VALUES
(1, 3, 3, 'Project Alpha', 'Description for Project Alpha', '2025-01-01', '2025-12-31', 'Approved', 'Project', 'Approved by PM', '', 25.00),
(2, 3, NULL, 'Project Beta', 'Description for Project Beta', NULL, '2025-11-30', 'Pending Approval', 'Proposal', 'Awaiting PM approval', '', 0.00),
(3, 3, 3, 'Project Gamma', 'Description for Project Gamma', '2025-02-01', '2025-10-15', 'Approved', 'Project', 'Approved by PM', '', 100.00),
(4, 3, NULL, 'Project Delta', 'Description for Project Delta', NULL, '2025-09-30', 'Pending Approval', 'Proposal', 'Awaiting PM approval', '', 0.00),
(5, 7, 4, 'Project Epsilon', 'Description for Project Epsilon', '2025-03-01', '2025-08-31', 'Completed', 'Project', 'Project handed over to client', 'Great job!', 0.00),
(6, 7, NULL, 'Project Zeta', 'Description for Project Zeta', NULL, '2025-07-31', 'Pending Approval', 'Proposal', 'Awaiting PM approval', '', 0.00),
(7, 10, 5, 'Project Eta', 'Description for Project Eta', '2025-04-01', '2025-12-01', 'Approved', 'Project', 'Approved by PM', '', 0.00),
(8, 10, NULL, 'Project Theta', 'Description for Project Theta', NULL, '2025-06-30', 'Pending Approval', 'Proposal', 'Awaiting PM approval', '', 0.00),
(9, 10, 6, 'Project Iota', 'Description for Project Iota', '2025-05-01', '2025-10-01', 'Approved', 'Project', 'Approved by PM', '', 0.00),
(10, 10, NULL, 'Project Kappa', 'Description for Project Kappa', NULL, '2025-09-01', 'Pending Approval', 'Proposal', 'Awaiting PM approval', '', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `developer_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `deadline` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Not Started',
  `pm_comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `project_id`, `developer_id`, `name`, `description`, `start_date`, `deadline`, `status`, `pm_comment`) VALUES
(1, 1, 2, 'Task 1', 'Description for Task 1', '2025-01-05', '2025-05-01', 'Completed', ''),
(2, 1, 6, 'Task 2', 'Description for Task 2', '2025-02-01', '2025-06-01', 'Not Started', ''),
(3, 2, 7, 'Task 3', 'Description for Task 3', '2025-02-15', '2025-07-01', 'In Progress', ''),
(4, 2, 3, 'Task 4', 'Description for Task 4', '2025-03-01', '2025-08-01', 'Pending Approval', ''),
(5, 3, 4, 'Task 5', 'Description for Task 5', '2025-04-01', '2025-09-01', 'Completed', ''),
(6, 1, 2, 'Task 1', 'Description for Task 1', '2025-01-01', '2025-01-31', 'In Progress', 'Reviewed by PM'),
(7, 1, 3, 'Task 2', 'Description for Task 2', '2025-02-01', '2025-02-28', 'In Progress', 'Requires additional resources');

--
-- Triggers `tasks`
--
DELIMITER $$
CREATE TRIGGER `update_project_progress` AFTER INSERT ON `tasks` FOR EACH ROW BEGIN
    DECLARE totalTasks INT DEFAULT 0;
    DECLARE completedTasks INT DEFAULT 0;
    DECLARE progress DECIMAL(5, 2) DEFAULT 0.00;

    -- Count total tasks for the project
    SELECT COUNT(*) INTO totalTasks FROM tasks WHERE project_id = NEW.project_id;

    -- Count completed tasks for the project
    SELECT COUNT(*) INTO completedTasks FROM tasks WHERE project_id = NEW.project_id AND status = 'Completed';

    -- Calculate progress
    SET progress = IF(totalTasks = 0, 0, (completedTasks * 100.0) / totalTasks);

    -- Update the progress in the projects table
    UPDATE projects SET progress = progress WHERE project_id = NEW.project_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_project_progress_after_insert` AFTER INSERT ON `tasks` FOR EACH ROW BEGIN
    DECLARE totalTasks INT DEFAULT 0;
    DECLARE completedTasks INT DEFAULT 0;
    DECLARE progress DECIMAL(5, 2) DEFAULT 0.00;

    -- Count total tasks for the project
    SELECT COUNT(*) INTO totalTasks FROM tasks WHERE project_id = NEW.project_id;

    -- Count completed tasks for the project
    SELECT COUNT(*) INTO completedTasks FROM tasks WHERE project_id = NEW.project_id AND status = 'Completed';

    -- Calculate progress
    SET progress = IF(totalTasks = 0, 0, (completedTasks * 100.0) / totalTasks);

    -- Update the progress in the projects table
    UPDATE projects SET progress = progress WHERE project_id = NEW.project_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_project_progress_after_update` AFTER UPDATE ON `tasks` FOR EACH ROW BEGIN
    DECLARE totalTasks INT DEFAULT 0;
    DECLARE completedTasks INT DEFAULT 0;
    DECLARE progress DECIMAL(5, 2) DEFAULT 0.00;

    -- Count total tasks for the project
    SELECT COUNT(*) INTO totalTasks FROM tasks WHERE project_id = NEW.project_id;

    -- Count completed tasks for the project
    SELECT COUNT(*) INTO completedTasks FROM tasks WHERE project_id = NEW.project_id AND status = 'Completed';

    -- Calculate progress
    SET progress = IF(totalTasks = 0, 0, (completedTasks * 100.0) / totalTasks);

    -- Update the progress in the projects table
    UPDATE projects SET progress = progress WHERE project_id = NEW.project_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `usr`
--

CREATE TABLE `usr` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roleid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usr`
--

INSERT INTO `usr` (`userid`, `firstname`, `lastname`, `username`, `email`, `password`, `roleid`) VALUES
(1, 'Md Asif', 'Chowdhury', 'NocillaX', 'asifjarif@gmail.com', '$2y$10$oWBK3vUqAFtNZqrctVu84e8rJDlOcoXFZ0HP6XvBiUc2IRpr.50X.', 3),
(2, 'John', 'Doe', 'jdoe', 'john.doe@example.com', '$2y$10$oWBK3vUqAFtNZqrctVu84e8rJDlOcoXFZ0HP6XvBiUc2IRpr.50X.', 3),
(3, 'Jane', 'Smith', 'jsmith', 'jane.smith@example.com', '$2y$10$oWBK3vUqAFtNZqrctVu84e8rJDlOcoXFZ0HP6XvBiUc2IRpr.50X.', 4),
(4, 'Alice', 'Brown', 'abrown', 'alice.brown@example.com', '$2y$10$oWBK3vUqAFtNZqrctVu84e8rJDlOcoXFZ0HP6XvBiUc2IRpr.50X.', 2),
(5, 'Bob', 'Johnson', 'bjohnson', 'bob.johnson@example.com', '$2y$10$oWBK3vUqAFtNZqrctVu84e8rJDlOcoXFZ0HP6XvBiUc2IRpr.50X.', 1),
(6, 'Charlie', 'White', 'cwhite', 'charlie.white@example.com', '$2y$10$oWBK3vUqAFtNZqrctVu84e8rJDlOcoXFZ0HP6XvBiUc2IRpr.50X.', 3),
(7, 'David', 'Black', 'dblack', 'david.black@example.com', '$2y$10$oWBK3vUqAFtNZqrctVu84e8rJDlOcoXFZ0HP6XvBiUc2IRpr.50X.', 4),
(8, 'Eve', 'Green', 'egreen', 'eve.green@example.com', '$2y$10$oWBK3vUqAFtNZqrctVu84e8rJDlOcoXFZ0HP6XvBiUc2IRpr.50X.', 2),
(9, 'Frank', 'Blue', 'fblue', 'frank.blue@example.com', '$2y$10$oWBK3vUqAFtNZqrctVu84e8rJDlOcoXFZ0HP6XvBiUc2IRpr.50X.', 3),
(10, 'Grace', 'Red', 'gred', 'grace.red@example.com', '$2y$10$oWBK3vUqAFtNZqrctVu84e8rJDlOcoXFZ0HP6XvBiUc2IRpr.50X.', 4),
(11, 'Hank', 'Yellow', 'hyellow', 'hank.yellow@example.com', '$2y$10$oWBK3vUqAFtNZqrctVu84e8rJDlOcoXFZ0HP6XvBiUc2IRpr.50X.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usr_role`
--

CREATE TABLE `usr_role` (
  `roleid` int(11) NOT NULL,
  `rolename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usr_role`
--

INSERT INTO `usr_role` (`roleid`, `rolename`) VALUES
(1, 'Admin'),
(2, 'ProjectManager'),
(3, 'Developer'),
(4, 'Client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `developer_id` (`developer_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `pm_id` (`pm_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `developer_id` (`developer_id`);

--
-- Indexes for table `usr`
--
ALTER TABLE `usr`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usr_role` (`roleid`);

--
-- Indexes for table `usr_role`
--
ALTER TABLE `usr_role`
  ADD PRIMARY KEY (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usr`
--
ALTER TABLE `usr`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usr_role`
--
ALTER TABLE `usr_role`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usr` (`userid`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`),
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`developer_id`) REFERENCES `usr` (`userid`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `usr` (`userid`),
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`pm_id`) REFERENCES `usr` (`userid`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`developer_id`) REFERENCES `usr` (`userid`);

--
-- Constraints for table `usr`
--
ALTER TABLE `usr`
  ADD CONSTRAINT `fk_usr_role` FOREIGN KEY (`roleid`) REFERENCES `usr_role` (`roleid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
