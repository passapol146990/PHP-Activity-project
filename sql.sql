CREATE TABLE account (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    aid         VARCHAR(255) UNIQUE NOT NULL,
    fname       VARCHAR(255) NOT NULL,
    lname       VARCHAR(255),
    birthday    DATE,
    gmail       VARCHAR(255),
    gender      VARCHAR(10),
    image       TEXT,
    datetime    DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE post (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    p_id        VARCHAR(255) UNIQUE NOT NULL,
    p_aid       VARCHAR(255) NOT NULL,
    p_name      VARCHAR(255),
    p_about     VARCHAR(1000),
    p_max       INT,
    p_address   VARCHAR(1000),
    p_date_start DATE,
    p_date_end  DATE,
    p_give    VARCHAR(1000),
    p_datetime  DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_create_aid FOREIGN KEY (p_aid) REFERENCES account(aid) ON DELETE CASCADE
);

CREATE TABLE image (
    id      INT AUTO_INCREMENT PRIMARY KEY,
    datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    image   VARCHAR(1000),
    pid     VARCHAR(255) NOT NULL,
    CONSTRAINT fk_image_pid FOREIGN KEY (pid) REFERENCES post(p_id) ON DELETE CASCADE
);

CREATE TABLE register (
    id      INT AUTO_INCREMENT PRIMARY KEY,
    datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    pid     VARCHAR(255) NOT NULL,
    cid     VARCHAR(255) NOT NULL, -- id user create
    aid     VARCHAR(255) NOT NULL, -- id user register
    status  VARCHAR(255),
    CONSTRAINT fk_pid FOREIGN KEY (pid) REFERENCES post(p_id) ON DELETE CASCADE,
    CONSTRAINT fk_cid FOREIGN KEY (cid) REFERENCES account(aid) ON DELETE CASCADE,
    CONSTRAINT fk_aid FOREIGN KEY (aid) REFERENCES account(aid) ON DELETE CASCADE
);

CREATE TABLE submit (
    id      INT AUTO_INCREMENT PRIMARY KEY,
    datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    image   VARCHAR(1000),
    pid     VARCHAR(255) NOT NULL,
    aid     VARCHAR(255) NOT NULL,
    status  VARCHAR(255),
    CONSTRAINT fk_post_pid FOREIGN KEY (pid) REFERENCES post(p_id) ON DELETE CASCADE, 
    CONSTRAINT fk_submit_aid FOREIGN KEY (aid) REFERENCES account(aid) ON DELETE CASCADE 
);



CREATE  VIEW count_registion_post AS
SELECT  post.*,(SELECT COUNT(*) FROM register WHERE register.pid = post.pid) AS r_count
FROM    post;
CREATE VIEW count_registion_false_post AS
SELECT  post.*,(SELECT COUNT(*) FROM register WHERE register.pid = post.pid AND register.status='ปฏิเสธ') AS f_count
FROM    post;
CREATE VIEW count_registion_true_post AS
SELECT  post.*,(SELECT COUNT(*) FROM register WHERE register.pid = post.pid AND register.status='อนุมัติ') AS t_count
FROM    post; 
-- SELECT * FROM post_with_r_count;
-- SELECT * FROM count_registion_false_post;
-- SELECT * FROM count_registion_true_post;
SELECT  *
FROM    account
WHERE   aid = ""
SELECT CEIL(COUNT(*) / 10) AS total_pages FROM post; -- จำนวนหน้าทั้งหมด

SELECT * FROM post ORDER BY p_datetime DESC LIMIT 10 OFFSET 0; -- ดึงมาที่ละ 1-10
SELECT * FROM post ORDER BY post_with_r_count DESC LIMIT 10 OFFSET 10; -- ดึงมาที่ละ 10-20

-- add data
INSERT INTO account (aid, fname, lname, birthday, gmail, gender) VALUES('hash(a@a.com&id)', '', '', '', 'a@a.com', ''),
INSERT INTO post (pid, p_aid, p_name, p_about, p_date, p_max, p_image, p_datetime) VALUES('pid', 'aid', 'p_name', 'p_about', '2025-03-01', 50, '/post/img.jpg', 0, 0, NOW()),
INSERT INTO register (pid, aid, status) VALUES ('P001', 'aid', 'รอ/อนุมัต/ปฏิเสธ'),
INSERT INTO submit (image, pid, aid, status) VALUES('/submit/img.jpg', 'P001', 'A002', 'Approved'),
-- update
UPDATE account SET birthday='1990-05-15',fname='passapol',lname='sutatam',gender='ชาย/หญิง' WHERE aid='hash(a@a.com&id)';
UPDATE post SET p_name='',p_about='',p_date='',p_max='',p_image='' WHERE pid='pid' AND p_aid='aid'; -- สำหรับแก้ไขโพสต์
UPDATE register SET status = 'รอ/อนุมัต/ปฏิเสธ' WHERE pid = 'pid' AND cid = 'aid' AND aid = 'aid'; -- สำหรับผู้สร้าง post
UPDATE submit SET status='ผ่าน/ไม่ผ่าน' WHERE id='id' AND aid='aid' -- สำหรับผู้สร้างโพสต์ตรวจสอบรูป
-- delete
DELETE FROM post WHERE id='id' AND p_aid="p_aid"; -- delete post
DELETE FROM register WHERE pid = 'pid' AND aid = 'aid'; -- ยกเลิกการขอเข้าร่วมกิจกรรม
DELETE FROM submit WHERE id = 'id' AND aid = 'aid';