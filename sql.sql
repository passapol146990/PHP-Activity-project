CREATE TABLE account (
    aid         VARCHAR(255) PRIMARY KEY,
    fname       VARCHAR(255) NOT NULL,
    lname       VARCHAR(255),
    birthday    DATE,
    gmail       VARCHAR(255),
    gender      VARCHAR(10),
    image       TEXT,
    datetime    DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE post (
    p_id        VARCHAR(255) PRIMARY KEY,
    p_aid       VARCHAR(255) NOT NULL,
    p_name      TEXT,
    p_about     TEXT,
    p_max       INT,
    p_address   TEXT,
    p_date_start DATE,
    p_date_end  DATE,
    p_give      TEXT,
    p_datetime  DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_create_aid FOREIGN KEY (p_aid) REFERENCES account(aid) ON DELETE CASCADE
);

CREATE TABLE image (
    id            int AUTO_INCREMENT PRIMARY KEY
    datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    image   TEXT,
    pid     VARCHAR(255) NOT NULL,
    CONSTRAINT fk_image_pid FOREIGN KEY (pid) REFERENCES post(p_id) ON DELETE CASCADE
);

CREATE TABLE register (
    id            int AUTO_INCREMENT PRIMARY KEY,
    datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    pid             VARCHAR(255) NOT NULL,
    aid             VARCHAR(255) NOT NULL, -- id user register
    status          VARCHAR(255), -- รอ,อนุมัติ,ปฏิเสธ
    datetime_submit date,
    image_submit    TEXT,
    status_submit   VARCHAR(255), -- ผ่าน,ไม่ผ่าน
    isRead          NOT NULL DEFAULT 0 
    CONSTRAINT fk_pid FOREIGN KEY (pid) REFERENCES post(p_id) ON DELETE CASCADE,
    CONSTRAINT fk_aid FOREIGN KEY (aid) REFERENCES account(aid) ON DELETE CASCADE
);
