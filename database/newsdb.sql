-- CSDL website tin tuc - MySQL (Laragon / HeidiSQL / phpMyAdmin)
-- Chay toan bo file nay de tao CSDL newsdb va du lieu mau
DROP DATABASE IF EXISTS newsdb;
CREATE DATABASE newsdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE newsdb;

CREATE TABLE users (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    name           VARCHAR(100) NOT NULL,
    email          VARCHAR(150)  NOT NULL UNIQUE,
    password       VARCHAR(255)  NOT NULL,
    role           VARCHAR(20)   NOT NULL DEFAULT 'editor',   -- admin | editor
    remember_token VARCHAR(100)  NULL,
    created_at     DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at     DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT CK_users_role CHECK (role IN ('admin','editor'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE categories (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    slug        VARCHAR(120)  NOT NULL UNIQUE,
    description VARCHAR(255) NULL,
    created_at  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE articles (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    title        VARCHAR(255) NOT NULL,
    slug         VARCHAR(280)  NOT NULL UNIQUE,
    summary      VARCHAR(500) NULL,
    content      LONGTEXT NOT NULL,
    image        VARCHAR(255)  NULL,
    category_id  INT NOT NULL,
    user_id      INT NOT NULL,
    views        INT NOT NULL DEFAULT 0,
    status       VARCHAR(20) NOT NULL DEFAULT 'published',    -- published | draft
    published_at DATETIME NULL,
    created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_articles_category FOREIGN KEY (category_id) REFERENCES categories(id),
    CONSTRAINT FK_articles_user     FOREIGN KEY (user_id)     REFERENCES users(id),
    CONSTRAINT CK_articles_status   CHECK (status IN ('published','draft'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE comments (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    article_id  INT NOT NULL,
    author_name VARCHAR(100)  NOT NULL,
    content     VARCHAR(1000) NOT NULL,
    is_approved TINYINT(1) NOT NULL DEFAULT 0,
    created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_comments_article FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE contacts (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(150)  NOT NULL,
    subject    VARCHAR(200) NULL,
    message    LONGTEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Du lieu mau
-- Tai khoan: admin@news.test / Admin@123 ; editor@news.test / Editor@123
INSERT INTO users (name, email, password, role) VALUES
('Quản trị viên', 'admin@news.test',  '$2y$10$eidRL1GQw8cPoR8ZLUrxauZ5vHez4kOHrc1ejgU9fwEORgn13FPm6', 'admin'),
('Biên tập viên', 'editor@news.test', '$2y$10$DkOjKxX10gkJ6IoAlcbN2.QQwQX9fLodZL4RhSpDBTvUVQDWI/kxe', 'editor');

INSERT INTO categories (name, slug, description) VALUES
('Thời sự',   'thoi-su',   'Tin tức trong nước và quốc tế'),
('Công nghệ', 'cong-nghe', 'Công nghệ, khoa học, sản phẩm số'),
('Thể thao',  'the-thao',  'Bóng đá và các môn thể thao'),
('Giáo dục',  'giao-duc',  'Tuyển sinh, du học, đào tạo');

INSERT INTO articles (title, slug, summary, content, category_id, user_id, views, status, published_at) VALUES
('Hà Nội triển khai thêm nhiều tuyến xe buýt điện', 'ha-noi-trien-khai-them-nhieu-tuyen-xe-buyt-dien',
 'Thành phố bổ sung các tuyến xe buýt điện nhằm giảm ô nhiễm và ùn tắc.',
 'Nhiều tuyến xe buýt điện mới sẽ được đưa vào hoạt động trong thời gian tới, kết nối khu vực nội đô với các khu đô thị vệ tinh.

Theo đại diện sở giao thông, việc mở rộng mạng lưới xe buýt điện giúp giảm khí thải, tiết kiệm chi phí vận hành và nâng cao chất lượng phục vụ hành khách.', 1, 1, 120, 'published', DATE_SUB(NOW(), INTERVAL 2 HOUR)),
('Thị trường việc làm ngành công nghệ thông tin phục hồi', 'thi-truong-viec-lam-nganh-cntt-phuc-hoi',
 'Nhu cầu tuyển dụng lập trình viên và kỹ sư dữ liệu tăng trở lại.',
 'Các doanh nghiệp công nghệ đang mở rộng tuyển dụng ở các vị trí lập trình web, di động, điện toán đám mây và phân tích dữ liệu.

Sinh viên mới ra trường được khuyến nghị trau dồi kỹ năng thực hành, ngoại ngữ và xây dựng sản phẩm cá nhân để tăng khả năng cạnh tranh.', 2, 2, 340, 'published', DATE_SUB(NOW(), INTERVAL 5 HOUR)),
('Trí tuệ nhân tạo được ứng dụng rộng rãi trong giáo dục', 'tri-tue-nhan-tao-trong-giao-duc',
 'Nhiều trường đại học thử nghiệm trợ lý AI hỗ trợ học tập.',
 'Các công cụ AI giúp cá nhân hóa lộ trình học, gợi ý tài liệu và hỗ trợ giảng viên chấm bài.

Tuy nhiên, các chuyên gia lưu ý cần quy định rõ về liêm chính học thuật và bảo mật dữ liệu người học.', 2, 1, 210, 'published', DATE_SUB(NOW(), INTERVAL 1 DAY)),
('Đội tuyển Việt Nam khởi đầu thuận lợi tại vòng loại', 'doi-tuyen-viet-nam-khoi-dau-thuan-loi',
 'Chiến thắng thuyết phục giúp đội tuyển vươn lên dẫn đầu bảng.',
 'Với lối chơi kỷ luật và tận dụng tốt cơ hội, đội tuyển đã giành trọn ba điểm trong trận ra quân.

Huấn luyện viên đánh giá cao tinh thần thi đấu của các cầu thủ và cho biết sẽ tiếp tục hoàn thiện lối chơi.', 3, 2, 95, 'published', DATE_SUB(NOW(), INTERVAL 1 DAY)),
('Công bố phương án tuyển sinh đại học năm mới', 'cong-bo-phuong-an-tuyen-sinh-dai-hoc',
 'Nhiều trường đa dạng hóa phương thức xét tuyển.',
 'Bên cạnh xét điểm thi tốt nghiệp, các trường tiếp tục sử dụng xét học bạ, đánh giá năng lực và chứng chỉ quốc tế.

Thí sinh cần theo dõi lịch đăng ký trên cổng thông tin của Bộ Giáo dục và Đào tạo.', 4, 1, 180, 'published', DATE_SUB(NOW(), INTERVAL 2 DAY)),
('Bão số mới có khả năng ảnh hưởng đến miền Trung', 'bao-so-moi-anh-huong-mien-trung',
 'Cơ quan khí tượng khuyến cáo người dân chủ động phòng tránh.',
 'Theo dự báo, áp thấp nhiệt đới có khả năng mạnh lên thành bão trong 48 giờ tới và di chuyển về phía đất liền.

Các địa phương được yêu cầu rà soát phương án sơ tán và bảo đảm an toàn cho tàu thuyền.', 1, 2, 260, 'published', DATE_SUB(NOW(), INTERVAL 3 DAY)),
('Bài viết nháp: Xu hướng điện toán đám mây', 'bai-viet-nhap-dien-toan-dam-may',
 'Bản nháp chưa xuất bản.', 'Nội dung đang được biên tập.', 2, 2, 0, 'draft', NULL);

INSERT INTO comments (article_id, author_name, content, is_approved) VALUES
(1, 'Minh Anh', 'Mong thành phố sớm mở rộng thêm nhiều tuyến.', 1),
(2, 'Quốc Huy', 'Bài viết hữu ích cho sinh viên năm cuối.', 1),
(2, 'Lan', 'Cần thêm thông tin về mức lương.', 0);

INSERT INTO contacts (name, email, subject, message) VALUES
('Nguyễn Văn A', 'a@example.com', 'Góp ý giao diện', 'Trang web dễ đọc, mong có thêm chuyên mục Đời sống.');
