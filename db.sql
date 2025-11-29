CREATE TABLE absence_table_creds(
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    kelas VARCHAR(50) NOT NULL,
    jurusan VARCHAR(50) NOT NULL
);

CREATE TABLE absence_table_abs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    credsId INT,
    kelas VARCHAR(50) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    keterangan VARCHAR(50) NOT NULL,
    FOREIGN KEY (credsId) REFERENCES absence_table_creds(id)
);