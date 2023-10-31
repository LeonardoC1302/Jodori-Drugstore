use farmacia_jodori;

select * from products;
select * from users;
select * from categories;
select * from cart;
select * from productsxcart;
select * from sales;
select * from productsxsale;

insert into categories(tipo) values("Medicina");
insert into categories(tipo) values("Dermatologia");
INSERT INTO products (name, description, price, cantidad, imagen, categoryID)
VALUES 
('Fastum Gel 25g Ungüento', 'Descripción del Fastum', 1420, 10, 'fastum.jpg', 1),
('Kalium INF X150 ml', 'Descripción del Kalium', 1815, 10, 'kalium.jpg', 1);

INSERT INTO products (name, description, price, cantidad, imagen, categoryID)
VALUES 
('Preservativos Durex Sabor Lizano', 'Mucho Sabor', 5000, 1, 'lizano.jpg', 1);

delete from users where id = 3;
alter table categories AUTO_INCREMENT = 3;
update users set verified = 1 where id = 7;
update users set token = "" where id = 7;
update users set admin = 1 where id = 4;
