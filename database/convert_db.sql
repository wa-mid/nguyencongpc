SELECT * FROM wp_posts WHERE post_type = 'product' AND post_status = 'imported' AND id >= 15581;

SELECT * FROM wp_posts WHERE post_type IN ('post', 'page') AND post_status = 'publish';

SELECT * FROM wp_postmeta WHERE post_id = 4629;

SELECT * FROM wp_posts WHERE post_name = 'case-antec-nx100-mid-tower';

SELECT * FROM wp_options WHERE option_value LIKE '%sc-gtgeip9M%';

SELECT * FROM wp_postmeta WHERE meta_key = '_sku';
SELECT * FROM wp_terms WHERE NAME = 'AEROCOOL';


SELECT * FROM wp_terms WHERE term_id IN (17,916,1228,1229,2338,2339,2340);

SELECT * FROM wp_term_taxonomy WHERE term_id IN (3206);

SELECT * FROM wp_term_taxonomy a JOIN wp_terms b ON a.term_id = b.term_id WHERE taxonomy = 'product_cat';
SELECT * FROM wp_term_taxonomy a JOIN wp_terms b ON a.term_id = b.term_id WHERE taxonomy = 'config';

SELECT * FROM wp_term_relationships WHERE term_taxonomy_id = 3061;

SELECT * FROM wp_term_relationships WHERE object_id = 4629;

INSERT INTO product_category (product_id,category_id)
SELECT object_id,term_taxonomy_id FROM wp_term_relationships WHERE term_taxonomy_id IN (SELECT id FROM category) AND object_id > 15581;


INSERT INTO category (id, `name`, slug, parent_id)
SELECT a.term_id, b.NAME, b.slug, a.parent  FROM wp_term_taxonomy a JOIN wp_terms b ON a.term_id = b.term_id WHERE taxonomy = 'product_cat';

post_content;

SELECT * FROM wp_term_taxonomy WHERE term_taxonomy_id != term_id;


UPDATE wp_posts SET post_status = 'publish' WHERE post_status = 'imported';

UPDATE product SET `status` = 1 WHERE trang_thai IS NULL;

INSERT INTO category (id, `name`, slug, parent_id)
SELECT a.term_id, b.NAME, b.slug, a.parent  FROM wp_term_taxonomy a JOIN wp_terms b ON a.term_id = b.term_id WHERE taxonomy = 'product_cat';

INSERT INTO filter (id, `name`, slug, parent_id)
SELECT a.term_id, b.NAME, b.slug, a.parent  FROM wp_term_taxonomy a JOIN wp_terms b ON a.term_id = b.term_id WHERE taxonomy = 'config';

INSERT INTO product_filter (product_id,filter_id)
SELECT object_id,term_taxonomy_id FROM wp_term_relationships WHERE term_taxonomy_id IN (SELECT id FROM filter) AND object_id > 15581;

UPDATE product SET content = NULL


SELECT * FROM wp_posts WHERE post_name = 'case-van-chay-nhung-man-khong-len-nguyen-nhan-va-cach-khac-phuc';

SELECT * FROM wp_postmeta WHERE post_id = 7936;

UPDATE product SET score = RAND()*3+7;

UPDATE product SET total_rate = RAND()*30+70;
is_device

SELECT * FROM wp_terms WHERE term_id = 243;
SELECT * FROM wp_term_taxonomy WHERE term_id = 243;


INSERT INTO post_category (id, `name`, slug, parent_id)
SELECT a.term_id, b.NAME, b.slug, a.parent  FROM wp_term_taxonomy a JOIN wp_terms b ON a.term_id = b.term_id WHERE taxonomy = 'category';


SELECT DISTINCT trang_thai FROM product;

UPDATE product SET `status` = 1 WHERE trang_thai IN ('Còn hàng', 'instock');

UPDATE product SET `status` = 2 WHERE trang_thai IN ('Hết hàng', 'outofstock');
UPDATE product SET `status` = 0 WHERE trang_thai IN ('Hết hàng', 'onbackorder');

UPDATE product SET attribute = 2 WHERE id IN (
SELECT DISTINCT product_id FROM product_category WHERE category_id = 194);

UPDATE posts SET image = REPLACE(image, 'https://nguyencongpc.vn', '');

UPDATE product SET image = REPLACE(image, 'https://nguyencongpc.vn', '');

UPDATE product SET images = REPLACE(images, 'https:\\\/\\\/nguyencongpc.vn', '');

SELECT image FROM product WHERE id > 15581;


UPDATE product SET is_device = 0 WHERE id IN (
SELECT DISTINCT product_id FROM product_category WHERE category_id IN (
	SELECT Id FROM category WHERE (id IN (408,407,1829) OR parent_id IN (408,407,1829))
)
);


UPDATE product SET score = RAND()*3+7;
UPDATE product SET total_rate = RAND()*3+5;


modifiedDate