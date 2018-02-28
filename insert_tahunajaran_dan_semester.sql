TRUNCATE TABLE tahunajaran;
INSERT INTO tahunajaran (tahunawal, tahunakhir) VALUES 
(2016, 2017), # 1
(2017, 2018), # 2
(2018, 2019), # 3
(2019, 2020), # 4
(2020, 2021), # 5
(2021, 2022), # 6
(2022, 2023), # 7
(2023, 2024), # 8
(2024, 2025), # 9
(2025, 2026); # 10


TRUNCATE TABLE semester;
INSERT INTO semester (ganjil_genap, tahunajaran_id) VALUES 
('ganjil', 1), ('genap', 1),
('ganjil', 2), ('genap', 2),
('ganjil', 3), ('genap', 3),
('ganjil', 4), ('genap', 4),
('ganjil', 5), ('genap', 5),
('ganjil', 6), ('genap', 6),
('ganjil', 7), ('genap', 7),
('ganjil', 8), ('genap', 8),
('ganjil', 9), ('genap', 9),
('ganjil', 10), ('genap', 10);