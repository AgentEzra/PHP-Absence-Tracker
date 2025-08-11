CREATE TABLE absence_table_abs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(50) NOT NULL,
    kelas VARCHAR(50) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    waktu TIMESTAMP,
    keterangan VARCHAR(50) NOT NULL
)

CREATE TABLE absence_table_creds (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL
)