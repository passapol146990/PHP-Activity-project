CREATE TABLE user (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    sid         VARCHAR(255) UNIQUE,
    username    VARCHAR(255) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,
    fname       VARCHAR(255),
    lname       VARCHAR(255),
    phone       VARCHAR(15),
    birthday    VARCHAR(20)
);

CREATE TABLE teacher (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    tid         VARCHAR(255) UNIQUE NOT NULL,
    name        VARCHAR(255) NOT NULL
);

CREATE TABLE subject (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    sub_id      VARCHAR(255) UNIQUE NOT NULL,
    tid         VARCHAR(255) NOT NULL,
    sub_name    TEXT NOT NULL,
    CONSTRAINT fk_subject_teacher FOREIGN KEY (tid) REFERENCES teacher(tid) ON DELETE CASCADE
);

CREATE TABLE registion (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    rid         VARCHAR(255) UNIQUE NOT NULL,
    sid         VARCHAR(255) NOT NULL,
    tid         VARCHAR(255) NOT NULL,
    sub_id      VARCHAR(255) NOT NULL,
    datatime    DATE,
    CONSTRAINT fk_registion_user FOREIGN KEY (sid) REFERENCES user(sid) ON DELETE CASCADE,
    CONSTRAINT fk_registion_teacher FOREIGN KEY (tid) REFERENCES teacher(tid) ON DELETE CASCADE,
    CONSTRAINT fk_registion_subject FOREIGN KEY (sub_id) REFERENCES subject(sub_id) ON DELETE CASCADE
);


INSERT INTO `teacher` (`id`, `tid`, `name`) VALUES (NULL, 't01', 'ดร.สวัดดี วันจัทนร์');
INSERT INTO `teacher` (`id`, `tid`, `name`) VALUES (NULL, 't02', 'ดร.นิติมุก หัวใจงาม');
INSERT INTO `teacher` (`id`, `tid`, `name`) VALUES (NULL, 't03', 'ดร.ยาวมาก แต่เล็กนิดเดียว');
INSERT INTO `teacher` (`id`, `tid`, `name`) VALUES (NULL, 't04', 'ดร.มีเยอะ แต่ประหยัด');
INSERT INTO `teacher` (`id`, `tid`, `name`) VALUES (NULL, 't05', 'ดร.พยาบาล เอสซีบี');


INSERT INTO `subject` (`id`, `sub_id`, `tid`, `sub_name`) VALUES (NULL, 'AA01', 't01', 'การลงทุนด้วยเงินหลักร้อย');
INSERT INTO `subject` (`id`, `sub_id`, `tid`, `sub_name`) VALUES (NULL, 'AA02', 't01', 'การลงทุนด้วยเงินหลักพัน');
INSERT INTO `subject` (`id`, `sub_id`, `tid`, `sub_name`) VALUES (NULL, 'AA03', 't01', 'การลงทุนด้วยเงินหลักหมื่น');
INSERT INTO `subject` (`id`, `sub_id`, `tid`, `sub_name`) VALUES (NULL, 'BB01', 't02', 'กฎหมายเอกสาร');
INSERT INTO `subject` (`id`, `sub_id`, `tid`, `sub_name`) VALUES (NULL, 'BB02', 't02', 'กฎหมายแรงงาน');
INSERT INTO `subject` (`id`, `sub_id`, `tid`, `sub_name`) VALUES (NULL, 'CC01', 't03', 'เครื่องสำอางและยาสระผม');
INSERT INTO `subject` (`id`, `sub_id`, `tid`, `sub_name`) VALUES (NULL, 'CC02', 't03', 'สบู่และครีมนวด');
INSERT INTO `subject` (`id`, `sub_id`, `tid`, `sub_name`) VALUES (NULL, 'DD01', 't04', 'การซื้ออาหารแบบคุ่มที่สุด');
INSERT INTO `subject` (`id`, `sub_id`, `tid`, `sub_name`) VALUES (NULL, 'EE01', 't05', 'การนวดเส้นบ่า');
INSERT INTO `subject` (`id`, `sub_id`, `tid`, `sub_name`) VALUES (NULL, 'EE02', 't05', 'แก้สัตว์มีพิษกันด้วยสมุนไพรพื้นบ้าน');