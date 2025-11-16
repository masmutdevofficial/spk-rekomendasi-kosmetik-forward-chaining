CREATE TABLE tb_admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(100) NOT NULL
);

CREATE TABLE tb_produk (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  gambar VARCHAR(100) DEFAULT NULL,
  kandungan TEXT DEFAULT NULL,
  merek VARCHAR(100) DEFAULT NULL,
  perusahaan VARCHAR(150) DEFAULT NULL,
  deskripsi TEXT DEFAULT NULL,
  harga DECIMAL(10,2) DEFAULT NULL,
  cara_penggunaan TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE tb_rule (
  id INT AUTO_INCREMENT PRIMARY KEY,
  jenis_kulit VARCHAR(100),
  masalah_kulit VARCHAR(100),
  efek VARCHAR(50),
  bebas_alkohol ENUM('Ya', 'Tidak'),
  produk_id INT,
  FOREIGN KEY (produk_id) REFERENCES tb_produk(id)
);

CREATE TABLE tb_fakta (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode VARCHAR(50) NOT NULL,
  pertanyaan TEXT NOT NULL,
  kategori ENUM('jenis_kulit', 'masalah_kulit', 'efek', 'bebas_alkohol') NOT NULL,
  aktif ENUM('Ya', 'Tidak') DEFAULT 'Ya'
);

CREATE TABLE tb_masukan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  jenis_kulit VARCHAR(100),
  masalah_kulit VARCHAR(100),
  efek VARCHAR(50),
  bebas_alkohol ENUM('Ya', 'Tidak'),
  produk_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (produk_id) REFERENCES tb_produk(id)
);

INSERT INTO tb_admin (username, password)
VALUES ('admin', MD5('admin'));


INSERT INTO tb_produk (nama, gambar, kandungan, merek, perusahaan, deskripsi, harga, cara_penggunaan) VALUES
('Somethinc Low pH Gentle Jelly Cleanser', NULL, 'Mugwort, Tea Tree, Centella',
 'Somethinc', 'PT Royal Pesona Indonesia',
 'Pembersih wajah berbahan vegan dengan tekstur jelly yang lembut, diformulasikan dengan Japanese Mugwort, Tea Tree, dan Centella Asiatica. Menyeimbangkan pH kulit tanpa membuatnya kering. Cocok untuk kulit sensitif dan bersertifikat halal.',
 130050, 'Basahi wajah, tuang cleanser ke tangan, pijat perlahan selama 10 detik, bilas dan keringkan.'),

('Wardah Perfect Bright Creamy Foam', NULL, 'Vitamin B3, Licorice',
 'Wardah', 'PT Paragon Technology and Innovation',
 'Facial foam dengan kandungan Vitamin B3 dan Licorice untuk mencerahkan dan melembutkan kulit. Hypoallergenic, bebas alkohol dan cocok untuk semua jenis kulit.',
 32500, 'Basahi wajah, busakan produk, pijat lembut, bilas hingga bersih. Gunakan bersama rangkaian Perfect Bright.'),

('POND''S Bright Beauty Facial Foam', NULL, 'Vitamin B3, Gluta-Boost Essence',
 'POND''S', 'PT Unilever Indonesia Tbk',
 'Serum facial foam dengan micro-exfoliating foam yang mengangkat kotoran dan membantu mencerahkan kulit. Mengandung Gluta-Boost Essence untuk mencerahkan secara optimal.',
 33500, 'Basahi wajah, gosok hingga berbusa, pijat pada wajah dan leher, lalu bilas. Gunakan dua kali sehari.'),

('Garnier Bright Complete Brightening Foam', NULL, 'Ekstrak Lemon',
 'Garnier', 'PT L''Oréal Indonesia',
 'Foam pembersih wajah dengan Vitamin Cg, pure lemon essence dan ekstrak Moringa yang membersihkan hingga 10 lapisan make-up dan polusi, serta mencerahkan wajah.',
 33500, 'Basahi wajah, tuang produk di tangan, beri air, gosok hingga berbusa, aplikasikan ke wajah dan bilas.'),

('Azarine Acne Gentle Cleansing Foam', NULL, 'Salicylic Acid, Tea Tree',
 'Azarine', 'PT Wahana Kosmetika Indonesia',
 'Pembersih wajah untuk kulit berjerawat dan berminyak. Mengandung Salicylic Acid dan Tea Tree untuk merawat jerawat dan mengontrol minyak berlebih.',
 35000, 'Tuangkan pada tangan, beri air, gosok di wajah hingga berbusa, bilas sampai bersih. Gunakan bersama Azarine Acne Series.'),

('Cetaphil Gentle Skin Cleanser', NULL, 'Non-Sabun, pH Seimbang',
 'Cetaphil', 'Galderma',
 'Pembersih wajah lembut bertekstur gel, cocok untuk kulit sensitif. Mengandung niacinamide, panthenol, dan gliserin untuk menjaga kelembapan dan melindungi dari iritasi.',
 9663, 'Oleskan ke kulit, pijat lembut. Bisa digunakan dengan atau tanpa air. Jika dengan air, bilas setelah pemakaian.'),

('Senka Perfect Whip', NULL, 'White Cocoon Essence',
 'Senka', 'Shiseido Company, Limited',
 'Facial foam dengan busa lembut yang mengandung White Cocoon Essence dan Double Hyaluronic Acid. Membersihkan hingga ke pori-pori dan menjaga kelembapan kulit.',
 41028, 'Basahi wajah, tuang produk ke telapak tangan, gosok hingga berbusa, aplikasikan dan bilas hingga bersih.'),

('Hada Labo Gokujyun Ultimate Moisturizing Face Wash', NULL, 'Hyaluronic Acid',
 'Hada Labo', 'Rohto Pharmaceutical Japan',
 'Pembersih wajah dengan dua jenis Hyaluronic Acid. Mengangkat kotoran tanpa membuat kulit kering dan menjaga kelembapan kulit.',
 46300, 'Tuangkan secukupnya pada telapak tangan, usapkan ke seluruh wajah, hindari mata, bilas hingga bersih.'),

('CeraVe Hydrating Facial Cleanser', NULL, 'Ceramide, Hyaluronic Acid',
 'CeraVe', 'L''Oréal',
 'Pembersih wajah non-foaming yang mengandung ceramides dan hyaluronic acid untuk menjaga skin barrier dan kelembapan kulit. Cocok untuk kulit normal hingga kering.',
 215000, 'Basahi wajah, aplikasikan dengan gerakan memutar lembut, lalu bilas dengan air.'),

('Clean & Clear Foaming Face Wash', NULL, 'Salicylic Acid',
 'Clean & Clear', 'PT Johnson & Johnson Indonesia',
 'Pembersih wajah untuk remaja yang membantu mengontrol minyak, mencegah jerawat, dan membersihkan wajah tanpa membuat kering.',
 24500, 'Gunakan dua kali sehari. Tuangkan ke telapak tangan basah, gosok hingga berbusa, usapkan dan bilas hingga bersih.'),

('Garnier Men Acno Fight Face Wash', NULL, 'Salicylic Acid, Charcoal',
 'Garnier', 'PT L''Oréal Indonesia',
 'Pembersih wajah pria dengan Salicylic Acid dan Herba Repair yang membantu melawan 6 tanda jerawat, mengurangi minyak berlebih, dan mencerahkan kulit.',
 37900, 'Basahi wajah, aplikasikan produk, pijat lembut, lalu bilas hingga bersih. Gunakan dua kali sehari.'),

('Kahf Triple Action Oil and Comedo Defense Face Wash', NULL, 'Charcoal, AHA-BHA-PHA',
 'Kahf', 'PT Paragon Technology and Innovation',
 'Pembersih wajah multifungsi dengan Charcoal dan AHA-BHA-PHA yang membantu mengangkat komedo, mengontrol minyak, dan dapat digunakan sebagai masker.',
 49000, 'Basahi wajah, aplikasikan produk, pijat lembut, lalu bilas hingga bersih. Sebagai masker, diamkan selama 1 menit sebelum dibilas.'),

('Sebamed Clear Face Cleansing Bar', NULL, 'Vitamin E, Squalane',
 'Sebamed', 'Sebapharma GmbH & Co. KG',
 'Sabun batang bebas sabun dengan pH 5.5 yang membantu mengurangi jerawat dan komedo, menjaga kelembapan kulit, serta cocok untuk kulit sensitif.',
 84900, 'Basahi wajah, gosok sabun hingga berbusa, aplikasikan ke wajah, lalu bilas hingga bersih.'),

('Acnes Foaming Wash', NULL, 'Isopropylmethylphenol, Vitamin C',
 'Acnes', 'Rohto Pharmaceutical Co., Ltd.',
 'Pembersih wajah berbentuk busa yang mengandung Isopropylmethylphenol untuk melawan bakteri penyebab jerawat dan Vitamin C untuk mencerahkan kulit.',
 63000, 'Basahi wajah, aplikasikan busa ke wajah, pijat lembut, lalu bilas hingga bersih.'),

('Skintific 5X Ceramide Low pH Cleanser', NULL, '5X Ceramide, pH Seimbang',
 'Skintific', 'PT Skintific Indonesia',
 'Pembersih wajah dengan 5 jenis Ceramide dan pH seimbang yang membantu menjaga skin barrier, melembapkan, dan cocok untuk kulit sensitif.',
 119000, 'Basahi wajah, aplikasikan produk, pijat lembut, lalu bilas hingga bersih.'),

('Safi Dermasafe Mild & Gentle Gel Cleanser', NULL, 'Licorice, Chamomile',
 'Safi', 'PT Unza Vitalis',
 'Pembersih wajah berbentuk gel yang lembut, bebas sabun, dan tanpa pewangi. Mengandung ekstrak Licorice dan Chamomile untuk membersihkan kotoran dan sebum berlebih serta menenangkan kulit sensitif.',
 49000, 'Basahi wajah, aplikasikan gel ke wajah, pijat lembut, lalu bilas hingga bersih.'),

('JF Sulfur Acne Cleanser Bar', NULL, 'Sulfur Aktif',
 'JF', 'PT Galenium Pharmasia Laboratories',
 'Sabun batang dengan kandungan sulfur aktif yang membantu mengurangi jerawat tanpa menyebabkan kulit menjadi kering. Membersihkan kotoran dan minyak berlebih pada kulit.',
 14200, 'Basahi wajah, gosok sabun hingga berbusa, aplikasikan ke wajah, hindari area mata, lalu bilas hingga bersih.'),

('Some By Mi AHA BHA PHA 30 Days Miracle Cleansing Bar', NULL, 'Tea Tree, AHA/BHA/PHA',
 'Some By Mi', 'Some By Mi Co., Ltd.',
 'Sabun batang yang mengandung Tea Tree, AHA, BHA, dan PHA untuk membersihkan pori-pori, mengangkat sel kulit mati, dan menenangkan kulit. Cocok untuk kulit berminyak dan berjerawat.',
 85000, 'Basahi wajah dengan air hangat, gosok sabun hingga berbusa, aplikasikan ke wajah dengan pijatan lembut selama 10 detik, lalu bilas hingga bersih.'),

('Naufa Pure Olive Oil Bar Soap', NULL, 'Minyak Zaitun, Susu Kambing',
 'Avoskin', 'PT Avo Innovation Technology',
 'Sabun batang yang mengandung minyak zaitun dan susu kambing untuk membersihkan wajah, mengangkat sel kulit mati, serta melembapkan dan mencerahkan kulit. Cocok untuk semua jenis kulit.',
 20000, 'Basahi wajah dan leher dengan air bersih, usapkan sabun ke telapak tangan hingga berbusa, aplikasikan ke wajah dengan pijatan ringan, lalu bilas hingga bersih.'),

('Kojie San Skin Brightening Soap', NULL, 'Kojic Acid, Vitamin C, E',
 'Kojie San', 'Beauty Elements Ventures Inc.',
 'Sabun batang yang diformulasikan dengan Kojic Acid, Vitamin C, dan E untuk mencerahkan kulit, menyamarkan bekas jerawat, dan menjaga kelembapan kulit. Cocok untuk wajah dan tubuh.',
 29000, 'Basahi sabun dan gosok hingga berbusa, aplikasikan ke wajah dengan pijatan lembut, lalu bilas hingga bersih.'),

('MS Glow Facial Wash', NULL, 'Glutathione, Collagen',
 'MS Glow', 'PT Kosmetika Cantik Indonesia',
 'Pembersih wajah dengan Glutathione dan Collagen yang membantu mencerahkan kulit, menjaga kelembapan, dan mengangkat sel kulit mati untuk kulit tampak lebih bersih dan segar.',
 60000, 'Basahi wajah, tekan pump secukupnya, usapkan pada wajah dengan gerakan memutar, lalu bilas hingga bersih.'),

('Nivea Sparkling White Whitening Facial Foam', NULL, 'Rucinol, Licorice, Vitamin C',
 'Nivea', 'PT Beiersdorf Indonesia',
 'Facial foam dengan kombinasi Rucinol, Licorice, dan Vitamin C yang membantu mencerahkan kulit, menyamarkan noda hitam, dan membuat kulit terasa kenyal dan sehat.',
 44400, 'Gunakan setiap pagi dan malam. Basahi wajah, usapkan produk, pijat lembut dengan gerakan melingkar ke atas, hindari area mata, lalu bilas hingga bersih.'),

('Himalaya Herbals Purifying Neem Face Wash', NULL, 'Neem, Kunyit',
 'Himalaya Herbals', 'PT The Himalaya Drug Company',
 'Pembersih wajah dengan Neem dan Kunyit yang membantu melawan bakteri penyebab jerawat, meratakan warna kulit, dan menenangkan kulit yang meradang. Cocok untuk semua jenis kulit.',
 30128, 'Basahi wajah, aplikasikan produk secukupnya, pijat lembut dengan gerakan melingkar, lalu bilas hingga bersih. Gunakan dua kali sehari.'),

('Mama''s Choice Gentle Face Wash', NULL, 'Rice Extract, Hydrolyzed Collagen',
 'Mama''s Choice', 'PT Mama''s Choice Indonesia',
 'Pembersih wajah dengan Rice Extract dan Hydrolyzed Collagen yang membantu melembapkan, mencerahkan, dan membuat kulit lebih kenyal. Diformulasikan khusus untuk ibu hamil dan menyusui.',
 89892, 'Basahi wajah, usapkan produk pada tangan hingga berbusa, pijat lembut wajah dengan gerakan memutar ke atas, lalu bilas dengan air bersih.'),

('Emina Bright Stuff Face Wash', NULL, 'Summer Plum Extract, Vitamin B3',
 'Emina', 'PT Paragon Technology and Innovation',
 'Pembersih wajah dengan Summer Plum Extract dan Vitamin B3 yang membantu membersihkan kotoran, mencerahkan kulit, dan menjaga kelembapan. Cocok digunakan setiap hari.',
 19500, 'Basahi wajah, tuangkan produk secukupnya ke telapak tangan, usapkan pada wajah dengan lembut selama 1-2 menit, lalu bilas dengan air bersih. Gunakan dua kali sehari.'),
 
('Biore Pore Detox Facial Foam', NULL, 'Charcoal, Tea Tree',
 'Biore', 'Kao Corporation',
 'Pembersih wajah dengan kandungan charcoal dan tea tree yang membantu membersihkan pori-pori secara mendalam dan mengontrol minyak berlebih.',
 45000, 'Basahi wajah, tuangkan produk ke tangan, gosok hingga berbusa, pijat lembut ke wajah, lalu bilas hingga bersih.'),

('L''Oreal Paris White Perfect Milky Foam', NULL, 'Tourmaline, Vitamin C',
 'L''Oreal Paris', 'PT L''Oréal Indonesia',
 'Pembersih wajah dengan kandungan Tourmaline dan Vitamin C yang membantu mencerahkan kulit dan mengurangi tampilan noda hitam.',
 60000, 'Basahi wajah, aplikasikan produk ke wajah, pijat lembut, lalu bilas hingga bersih.'),

('The Body Shop Tea Tree Skin Clearing Facial Wash', NULL, 'Tea Tree Oil',
 'The Body Shop', 'PT Monica Hijau Lestari',
 'Pembersih wajah dengan kandungan tea tree oil yang membantu membersihkan kulit dari kotoran dan minyak berlebih serta membantu mengurangi jerawat.',
 249000, 'Basahi wajah, tuangkan produk ke tangan, gosok hingga berbusa, pijat lembut ke wajah, lalu bilas hingga bersih.'),

('Innisfree Jeju Volcanic Pore Cleansing Foam', NULL, 'Jeju Volcanic Ash',
 'Innisfree', 'Amorepacific Corporation',
 'Pembersih wajah dengan kandungan Jeju volcanic ash yang membantu menyerap sebum berlebih dan membersihkan pori-pori secara mendalam.',
 120000, 'Basahi wajah, tuangkan produk ke tangan, gosok hingga berbusa, pijat lembut ke wajah, lalu bilas hingga bersih.'),

('The Face Shop Rice Water Bright Cleansing Foam', NULL, 'Ekstrak Beras',
 'The Face Shop', 'LG Household & Health Care',
 'Pembersih wajah dengan ekstrak beras yang membantu mencerahkan dan melembapkan kulit serta membersihkan kotoran dan sisa makeup.',
 185000, 'Basahi wajah, tuangkan produk ke tangan, gosok hingga berbusa, pijat lembut ke wajah, lalu bilas hingga bersih.'),

('Erha Acneact Acne Cleanser Scrub', NULL, 'Salicylic Acid, Scrub Halus',
 'Erha', 'PT Erha Indonesia',
 'Pembersih wajah dengan scrub halus dan kandungan salicylic acid yang membantu mengangkat sel kulit mati dan mengurangi jerawat.',
 99000, 'Basahi wajah, aplikasikan produk ke wajah, pijat lembut dengan gerakan melingkar, lalu bilas hingga bersih.'),

('The Ordinary Squalane Cleanser', NULL, 'Squalane',
 'The Ordinary', 'DECIEM Inc.',
 'Pembersih wajah dengan kandungan squalane yang membantu menghapus makeup dan kotoran tanpa mengeringkan kulit, menjaga kelembapan alami kulit.',
 285000, 'Tuangkan produk ke tangan, gosok hingga berubah menjadi minyak, aplikasikan ke wajah kering, pijat lembut, lalu bilas dengan air hangat.'),

('Cosrx Low pH Good Morning Gel Cleanser', NULL, 'Tea Tree Oil, BHA',
 'Cosrx', 'Cosrx Inc.',
 'Pembersih wajah dengan pH rendah yang mengandung tea tree oil dan BHA, membantu membersihkan kulit tanpa mengiritasi dan menjaga keseimbangan pH kulit.',
 150000, 'Basahi wajah, tuangkan produk ke tangan, gosok hingga berbusa, pijat lembut ke wajah, lalu bilas hingga bersih.'),

('Avoskin Your Skin Bae Cleanser', NULL, 'Niacinamide, Centella Asiatica',
 'Avoskin', 'PT Avo Innovation Technology',
 'Pembersih wajah dengan kandungan niacinamide dan centella asiatica yang membantu mencerahkan kulit dan menenangkan iritasi.',
 89000, 'Basahi wajah, tuangkan produk ke tangan, gosok hingga berbusa, pijat lembut ke wajah, lalu bilas hingga bersih.'),

('Benton Honest Cleansing Foam', NULL, 'Camellia Japonica Seed Oil',
 'Benton', 'Benton Inc.',
 'Pembersih wajah dengan kandungan camellia japonica seed oil yang membantu membersihkan kulit dari kotoran dan menjaga kelembapan kulit.',
 120000, 'Basahi wajah, tuangkan produk ke tangan, gosok hingga berbusa, pijat lembut ke wajah, lalu bilas hingga bersih.'),

('Klairs Rich Moist Foaming Cleanser', NULL, 'Amino Acid, Hyaluronic Acid',
 'Klairs', 'Wishcompany Inc.',
 'Pembersih wajah berbusa yang lembut, mengandung amino acid dan hyaluronic acid untuk menjaga kelembapan kulit. Cocok untuk semua jenis kulit, termasuk kulit sensitif.',
 320000, 'Basahi wajah dengan air hangat, aplikasikan 3-4 pump cleanser, pijat lembut dengan gerakan melingkar, lalu bilas dengan air hangat.'),

('Pixy White Aqua Gentle Facial Wash', NULL, 'Hydra Active, Vitamin C',
 'Pixy', 'PT Mandom Indonesia Tbk',
 'Sabun pembersih wajah berbahan dasar air yang segar dan ringan, membantu mengurangi tanda-tanda kulit lelah seperti kusam, serta membuat kulit terasa halus dan lembut.',
 32514, 'Tuangkan secukupnya pada telapak tangan, beri sedikit air, usapkan pada seluruh wajah hingga berbusa, sambil dipijat dengan lembut, lalu bilas hingga bersih.'),

('Sariayu Putih Langsat Facial Foam', NULL, 'Ekstrak Langsat, Vitamin C',
 'Sariayu', 'PT Martina Berto Tbk',
 'Busa pembersih wajah yang mengandung ekstrak buah langsat dan vitamin C, membersihkan secara menyeluruh semua sisa debu, kotoran, dan minyak berlebih, serta mencerahkan kulit.',
 23050, 'Keluarkan secukupnya ke telapak tangan, basahi dengan air hingga berbusa, usapkan pada wajah dan pijat perlahan, lalu bilas hingga bersih.'),

('Viva Milk Cleanser', NULL, 'Susu, Minyak Zaitun',
 'Viva', 'PT Vitapharm',
 'Pembersih wajah dengan kandungan susu dan minyak zaitun, membantu membersihkan kotoran dan sisa makeup, serta menjaga kelembapan kulit.',
 9000, 'Oleskan Viva Milk Cleanser pada kulit wajah dan leher, lakukan pijatan ringan, kemudian angkat dengan tisu atau kapas bersih.'),

('Mustika Ratu Sabun Sari Jeruk Nipis', NULL, 'Ekstrak Jeruk Nipis',
 'Mustika Ratu', 'PT Mustika Ratu Tbk',
 'Sabun pembersih wajah dengan ekstrak jeruk nipis, membantu mengurangi minyak berlebih dan memberikan kesegaran pada kulit.',
 18889, 'Letakkan pembersih di lima bagian muka (dahi, pipi kiri, pipi kanan, hidung, dan dagu), lakukan gerakan melingkar ke seluruh wajah hingga kotoran larut, bersihkan dengan kapas atau waslap ke arah atas.'),

('Pigeon Facial Foam', NULL, 'Ekstrak Jojoba, Chamomile',
 'Pigeon', 'PT Multi Indocitra Tbk',
 'Pembersih wajah dengan ekstrak jojoba dan chamomile, membersihkan wajah dengan lembut dan menjaga kelembapan kulit.',
 23000, 'Keluarkan isi secukupnya di telapak tangan, busakan, usapkan pada wajah dan pijat dengan lembut, lalu bilas hingga bersih.'),

('Marina UV White Brightening Facial Foam', NULL, 'Vitamin B3, Licorice',
 'Marina', 'PT Barclay Products',
 'Pembersih wajah dengan Biowhitening Complex dari Vitamin B3 dan Licorice, membantu mencerahkan kulit dan menjaga kelembapan.',
 32500, 'Usapkan pada wajah yang sudah dibasahi sambil dipijat lembut, lalu bilas hingga bersih.'),

('Garnier Pure Active Matcha Deep Clean Foam', NULL, 'Matcha, Salicylic Acid',
 'Garnier', 'PT L''Oréal Indonesia',
 'Pembersih wajah dengan ekstrak matcha dan salicylic acid, membantu membersihkan minyak berlebih dan debu polusi, serta mencerahkan kulit.',
 19000, 'Basahi wajah dengan air, tuangkan produk pada tangan, aplikasikan ke wajah dengan gerakan memutar, lalu bilas hingga bersih.'),

('Pond''s Men Energy Bright Face Wash', NULL, 'Coffee Bean Extract',
 'Pond''s', 'PT Unilever Indonesia Tbk',
 'Pembersih wajah pria dengan ekstrak biji kopi, membantu membersihkan kotoran dan minyak, serta memberikan kesegaran pada wajah.',
 35000, 'Basahi wajah, tuangkan produk ke tangan, gosok hingga berbusa, aplikasikan ke wajah dengan pijatan lembut, lalu bilas hingga bersih.'),

('Vaseline Men Oil Control Face Wash', NULL, 'Mineral Clay, Vitamin B3',
 'Vaseline', 'PT Unilever Indonesia Tbk',
 'Pembersih wajah pria dengan mineral clay dan vitamin B3, membantu mengontrol minyak berlebih dan membersihkan pori-pori.',
 33000, 'Basahi wajah, aplikasikan produk ke tangan, gosok hingga berbusa, pijat lembut pada wajah, lalu bilas hingga bersih.'),

('Clorismen Facial Wash', NULL, 'Tea Tree Oil, Aloe Vera',
 'Clorismen', 'PT Clorismen Indonesia',
 'Pembersih wajah pria dengan kandungan Tea Tree Oil dan Aloe Vera yang membantu mengurangi minyak berlebih dan menjaga kelembapan kulit.',
 50000, 'Basahi wajah, aplikasikan produk, pijat lembut, lalu bilas hingga bersih. Gunakan dua kali sehari.'),

('SR12 Facial Wash Coffee', NULL, 'Ekstrak Kopi, Aloe Vera',
 'SR12', 'PT SR12 Herbal Perkasa',
 'Sabun wajah dengan ekstrak kopi dan aloe vera yang membantu mengangkat kotoran, mencerahkan kulit, dan menjaga kelembapan.',
 25000, 'Basahi wajah, gosok sabun hingga berbusa, aplikasikan ke wajah, lalu bilas hingga bersih. Gunakan secara rutin.'),

('M-Joptim Acid Gentle Cleanser', NULL, 'Amino Acid, pH Seimbang',
 'M-Joptim', 'M-Joptim Skincare',
 'Pembersih wajah dengan amino acid dan pH seimbang yang membersihkan kulit tanpa menyebabkan iritasi, cocok untuk semua jenis kulit.',
 198000, 'Basahi wajah, aplikasikan produk, pijat lembut, lalu bilas hingga bersih. Gunakan dua kali sehari.'),

('Precious Skin Gluta White Soap', NULL, 'Glutathione, Vitamin C',
 'Precious Skin', 'Precious Skin Thailand',
 'Sabun pemutih dengan kandungan glutathione dan vitamin C yang membantu mencerahkan kulit dan mengurangi noda hitam.',
 22500, 'Basahi wajah, gosok sabun hingga berbusa, aplikasikan ke wajah, lalu bilas hingga bersih. Gunakan secara rutin.'),

('Mezucca Saffron Soap', NULL, 'Saffron, Vitamin E',
 'Mezucca', 'PT Mezuca Indonesia',
 'Sabun wajah dengan ekstrak saffron dan vitamin E yang membantu mencerahkan kulit, mengurangi jerawat, dan menjaga kelembapan.',
 12500, 'Basahi wajah, gosok sabun hingga berbusa, aplikasikan ke wajah, lalu bilas hingga bersih. Gunakan pagi dan malam hari.');

INSERT INTO tb_rule (jenis_kulit, masalah_kulit, efek, bebas_alkohol, produk_id) VALUES
('Kulit Berminyak', 'Jerawat', 'Mengontrol Minyak', 'Ya', 1),
('Kulit Sensitif', 'Kemerahan', 'Melembapkan', 'Ya', 2),
('Kulit Kombinasi', 'Flek/Noda', 'Mencerahkan', 'Tidak', 3),
('Kulit Kering', 'Kusam', 'Eksfoliasi', 'Ya', 4),
('Kulit Berjerawat', 'Jerawat', 'Mengontrol Minyak', 'Ya', 5),
('Kulit Berminyak', 'Tanpa Masalah Khusus', 'Mencerahkan', 'Tidak', 6),
('Kulit Sensitif', 'Kemerahan', 'Melembapkan', 'Ya', 7),
('Kulit Kombinasi', 'Flek/Noda', 'Eksfoliasi', 'Ya', 8),
('Kulit Kering', 'Kusam', 'Mencerahkan', 'Ya', 9),
('Kulit Berjerawat', 'Jerawat', 'Eksfoliasi', 'Tidak', 10),
('Kulit Berminyak', 'Kusam', 'Mencerahkan', 'Ya', 11),
('Kulit Sensitif', 'Tanpa Masalah Khusus', 'Melembapkan', 'Ya', 12),
('Kulit Kombinasi', 'Jerawat', 'Mengontrol Minyak', 'Ya', 13),
('Kulit Kering', 'Flek/Noda', 'Mencerahkan', 'Ya', 14),
('Kulit Berjerawat', 'Jerawat', 'Mengontrol Minyak', 'Ya', 15),
('Kulit Berminyak', 'Kemerahan', 'Mencerahkan', 'Tidak', 16),
('Kulit Sensitif', 'Jerawat', 'Melembapkan', 'Ya', 17),
('Kulit Kombinasi', 'Tanpa Masalah Khusus', 'Eksfoliasi', 'Tidak', 18),
('Kulit Kering', 'Kusam', 'Mencerahkan', 'Ya', 19),
('Kulit Berjerawat', 'Flek/Noda', 'Eksfoliasi', 'Ya', 20),
('Kulit Berminyak', 'Jerawat', 'Mengontrol Minyak', 'Ya', 21),
('Kulit Sensitif', 'Kemerahan', 'Melembapkan', 'Ya', 22),
('Kulit Kombinasi', 'Flek/Noda', 'Mencerahkan', 'Tidak', 23),
('Kulit Kering', 'Kusam', 'Eksfoliasi', 'Ya', 24),
('Kulit Berjerawat', 'Jerawat', 'Mengontrol Minyak', 'Tidak', 25),
('Kulit Berminyak', 'Kemerahan', 'Melembapkan', 'Ya', 26),
('Kulit Sensitif', 'Tanpa Masalah Khusus', 'Mencerahkan', 'Ya', 27),
('Kulit Kombinasi', 'Jerawat', 'Eksfoliasi', 'Tidak', 28),
('Kulit Kering', 'Flek/Noda', 'Mencerahkan', 'Ya', 29),
('Kulit Berjerawat', 'Kusam', 'Melembapkan', 'Ya', 30),
('Kulit Berminyak', 'Tanpa Masalah Khusus', 'Mencerahkan', 'Ya', 31),
('Kulit Sensitif', 'Jerawat', 'Mengontrol Minyak', 'Tidak', 32),
('Kulit Kombinasi', 'Kusam', 'Mencerahkan', 'Ya', 33),
('Kulit Kering', 'Tanpa Masalah Khusus', 'Eksfoliasi', 'Ya', 34),
('Kulit Berjerawat', 'Jerawat', 'Mengontrol Minyak', 'Ya', 35),
('Kulit Berminyak', 'Flek/Noda', 'Eksfoliasi', 'Tidak', 36),
('Kulit Sensitif', 'Kemerahan', 'Melembapkan', 'Ya', 37),
('Kulit Kombinasi', 'Jerawat', 'Mengontrol Minyak', 'Ya', 38),
('Kulit Kering', 'Kusam', 'Mencerahkan', 'Tidak', 39),
('Kulit Berjerawat', 'Jerawat', 'Eksfoliasi', 'Ya', 40),
('Kulit Berminyak', 'Kemerahan', 'Mengontrol Minyak', 'Ya', 41),
('Kulit Sensitif', 'Flek/Noda', 'Mencerahkan', 'Tidak', 42),
('Kulit Kombinasi', 'Tanpa Masalah Khusus', 'Eksfoliasi', 'Ya', 43),
('Kulit Kering', 'Flek/Noda', 'Mencerahkan', 'Ya', 44),
('Kulit Berjerawat', 'Kusam', 'Mencerahkan', 'Ya', 45),
('Kulit Berminyak', 'Tanpa Masalah Khusus', 'Melembapkan', 'Tidak', 46),
('Kulit Sensitif', 'Kemerahan', 'Mencerahkan', 'Ya', 47),
('Kulit Kombinasi', 'Jerawat', 'Mengontrol Minyak', 'Ya', 48),
('Kulit Kering', 'Tanpa Masalah Khusus', 'Eksfoliasi', 'Tidak', 49),
('Kulit Berjerawat', 'Jerawat', 'Mencerahkan', 'Ya', 50);

INSERT INTO tb_fakta (kode, pertanyaan, kategori, aktif) VALUES
('F1', 'Apa jenis kulit Anda?', 'jenis_kulit', 'Ya'),
('F2', 'Apa masalah utama kulit Anda?', 'masalah_kulit', 'Ya'),
('F3', 'Efek apa yang Anda inginkan dari produk?', 'efek', 'Ya'),
('F4', 'Apakah Anda ingin produk bebas alkohol?', 'bebas_alkohol', 'Ya');
