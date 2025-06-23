-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 16 juin 2025 à 18:01
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

create database dons ;
use dons ;

CREATE TABLE `utilisateurs` (
  `idUser` int(11) NOT NULL,
  `nomComplet` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Motdepasse` varchar(12) NOT NULL
); ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `utilisateurs`
  ADD UNIQUE KEY `Email` (`Email`);
COMMIT;



INSERT INTO utilisateurs (nomComplet, Email, Motdepasse) 
VALUES ('diarra', 'diarra@odc.sn', 'passer');
