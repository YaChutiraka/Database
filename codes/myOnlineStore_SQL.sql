CREATE TABLE User (
id INT NOT NULL AUTO INCREMENT PRIMARY KEY,
name VARCHAR(100),
address VARCHAR(300),
email VARCHAR(100),
password VARCHAR(20),
is_staff CHAR(1)
);

CREATE TABLE Product (
id INT NOT NULL AUTO INCREMENT PRIMARY KEY,
name CHAR(100),
price DECIMAL(19,2),
stock_quantity INT,
description CHAR(255),
active CHAR(1)
);

CREATE TABLE Supplier (
id INT NOT NULL AUTO INCREMENT PRIMARY KEY,
name CHAR(100)
);

CREATE TABLE OrderMade (
id INT NOT NULL AUTO INCREMENT PRIMARY KEY,
date DATE,
paid CHAR(1)
);

CREATE TABLE Supplies (
supplier_id INT,
product_id INT PRIMARY KEY,
FOREIGN KEY (supplier_id)
REFERENCES Supplier (id)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (product_id)
REFERENCES Product (id)
ON DELETE CASCADE
ON UPDATE CASCADE
);

CREATE TABLE Orders (
user_id INT,
order_id INT NOT NULL PRIMARY KEY,
FOREIGN KEY (user_id)
REFERENCES User (id)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (order_id)
REFERENCES OrderMade (id)
ON DELETE CASCADE
ON UPDATE CASCADE
);

CREATE TABLE Contains (
order_id INT,
quantity INT,
product_id INT,
FOREIGN KEY (order_id)
REFERENCES OrderMade (id)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (product_id)
REFERENCES Product (id)
ON DELETE SET NULL
ON UPDATE CASCADE
);

INSERT INTO User VALUES ('1', 'Emma Watson', '734 Hogwarts Rd, Orlando, FL 36816', 'wizardy@bellsouth.net', '!', 'N');
INSERT INTO User VALUES ('2', 'Peter Hollens', '5234 Acapella St, Gainesville, FL 32612', 'singoutloud@yahoo.com', 'UFRocks!', 'Y');
INSERT INTO User VALUES ('3', 'Johnny Walker', '5234 Whiskey Ave, Tallahasee, FL 30817', 'ABC@gmail.com', 'BeResponsible123', 'N');
INSERT INTO User VALUES ('4', 'Mariah Carrey', '5234 High Notes Circle, San Fransisco, CA 98528', 'hero@yahoo.com', 'WithoutU245', 'N');
INSERT INTO User VALUES ('5', 'Carrie Underwood', '5234 Country Rd, Nashville, TN 19474', 'underwood@gmail.com', 'ILoveCountry!', 'N');
INSERT INTO OrderMade VALUES ('1', '2014-12-22', 'Y');
INSERT INTO OrderMade VALUES ('3045', '2015-02-17', 'Y');
INSERT INTO OrderMade VALUES ('19473', '2015-06-04', 'Y');
INSERT INTO OrderMade VALUES ('30605', '2014-10-31', 'Y');
INSERT INTO OrderMade VALUES ('70393', '2015-11-13', 'N');
INSERT INTO Product VALUES ('1', 'Pantene Shampoo', 5.50, 50, 'This shampoo works well for those with dry hair.', 'Y');
INSERT INTO Product VALUES ('2', 'Lux Body Soap', 4.00, 50, 'This soap works well for those with dry skin.', 'N');
INSERT INTO Product VALUES ('3', 'Olay Facial Cream', 15.00, 50, 'Night cream that will help your face stay moisturized.', 'Y');
INSERT INTO Product VALUES ('4', 'Ethernet Cable', 10.00, 50, 'Used to connect to the internet. Length is 4 ft.', 'Y');
INSERT INTO Product VALUES ('5', 'Seasonal Assorted Chocolates', 8.50, 50, 'Box of 16 assorted chocolates with many seasonal flavors. Works perfectly as a gift!', 'N');
INSERT INTO Supplier VALUES ('1', 'Ulta Beauty Supplies');
INSERT INTO Supplier VALUES ('2', 'GODIVA');
INSERT INTO Supplier VALUES ('3', 'Hallmark');
INSERT INTO Supplier VALUES ('4', 'Fisher Price');
INSERT INTO Supplier VALUES ('5', 'Rocketfish');
INSERT INTO Orders VALUES ('4', '1');
INSERT INTO Orders VALUES ('1', '3045');
INSERT INTO Orders VALUES ('5', '19473');
INSERT INTO Orders VALUES ('4', '30605');
INSERT INTO Orders VALUES ('3', '70393');
INSERT INTO Contains VALUES ('1', 2, '3');
INSERT INTO Contains VALUES ('3045', 1, '1');
INSERT INTO Contains VALUES ('19473', 2, '4');
INSERT INTO Contains VALUES ('30605', 2, '3');
INSERT INTO Contains VALUES ('70393', 10, '5');
INSERT INTO Supplies VALUES ('1', '1');
INSERT INTO Supplies VALUES ('1', '2');
INSERT INTO Supplies VALUES ('1', '3');
INSERT INTO Supplies VALUES ('5', '4');
INSERT INTO Supplies VALUES ('2', '5');


DELIMITER //
CREATE PROCEDURE lowStockMessage(IN prod_id VARCHAR(8), IN prod_name CHAR(100))
BEGIN
SELECT 'THE QUANTITY OF STOCK FOR ' + prod_id + ' ' + prod_name + ' IS LOW! PLEASE CONTACT SUPPLIER FOR MORE STOCK AS SOON AS POSSIBLE!';
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER checkForLowStock
BEFORE UPDATE ON Product
FOR EACH ROW
BEGIN
	IF (New.stock_quantity < 20) THEN
		CALL lowStockMessage(New.id, New.name);
       END IF; 
END;
