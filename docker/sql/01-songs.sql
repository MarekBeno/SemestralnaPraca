-- Tabuľka piesní pre aplikáciu MusicList (model App\Models\Song).
-- Skript sa automaticky vykoná pri prvom spustení databázového kontajnera.
SET NAMES utf8mb4;

CREATE TABLE `songs`
(
    `id`       INT AUTO_INCREMENT PRIMARY KEY,
    `title`    VARCHAR(100) NOT NULL,
    `tonality` VARCHAR(20)  NOT NULL,
    `genre`    VARCHAR(50)  NOT NULL,
    `author`   VARCHAR(100) NOT NULL
) DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ukážkové dáta
INSERT INTO `songs` (`title`, `tonality`, `genre`, `author`)
VALUES ('Kopala studienku', 'G dur', 'Ľudová', 'Marek Beňo'),
       ('Viedenský valčík', 'C dur', 'Valčík', 'Eva Kováčová'),
       ('Polka z Detvy', 'B dur', 'Polka', 'Ján Novák');
