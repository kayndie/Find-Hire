CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('applicant', 'hr') NOT NULL
);

CREATE TABLE job_posts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  hr_id INT NOT NULL,
  FOREIGN KEY (hr_id) REFERENCES users(id)
);

CREATE TABLE applications (
  id INT PRIMARY KEY AUTO_INCREMENT,
  job_post_id INT NOT NULL,
  applicant_id INT NOT NULL,
  hr_id INT NOT NULL,
  resume BLOB NOT NULL,
  description TEXT NOT NULL,
  status ENUM('pending', 'accepted', 'rejected') NOT NULL DEFAULT 'pending',
  FOREIGN KEY (job_post_id) REFERENCES job_posts(id),
  FOREIGN KEY (applicant_id) REFERENCES users(id)
);

CREATE TABLE messages (
  id INT PRIMARY KEY AUTO_INCREMENT,
  sender_id INT NOT NULL,
  receiver_id INT NOT NULL,
  message TEXT NOT NULL,
  FOREIGN KEY (sender_id) REFERENCES users(id),
  FOREIGN KEY (receiver_id) REFERENCES users(id)
);
