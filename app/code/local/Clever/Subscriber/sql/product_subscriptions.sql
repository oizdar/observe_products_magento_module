CREATE TABLE product_subscriptions
(
  email VARCHAR(255) NOT NULL,
  product_id INT NOT NULL,
  PRIMARY KEY (email, product_id)
) DEFAULT CHARSET=utf8;

