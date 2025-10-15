CREATE DATABASE crud_web_db;
USE crud_web_db;

CREATE TABLE mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  nim VARCHAR(20),
  jurusan VARCHAR(100)
);

CREATE TABLE dosen (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  nip VARCHAR(20),
  keahlian VARCHAR(100)
);

CREATE TABLE matakuliah (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode VARCHAR(20),
  nama VARCHAR(100),
  sks INT
);
