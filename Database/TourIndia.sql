-- Drop the existing tables if they exist
DROP TABLE IF EXISTS `admin_login`;
DROP TABLE IF EXISTS `hotels`;
DROP TABLE IF EXISTS `login`;
DROP TABLE IF EXISTS `city_packages`;
DROP TABLE IF EXISTS `bookings`;

-- Create the admin_login table
CREATE TABLE `admin_login` (
  `srno` INT(3) NOT NULL AUTO_INCREMENT,
  `Admin_Name` VARCHAR(100) NOT NULL,
  `Admin_Password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert data into admin_login table
INSERT INTO `admin_login` (`Admin_Name`, `Admin_Password`) VALUES
('Admin', 'Admin'),
('Roshni', 'Roshni'),
('Parul', 'Parul'),
('Dushyant', 'Dushyant');

-- Create the hotels table
CREATE TABLE `hotels` (
  `hotelid` INT PRIMARY KEY,
  `hotel_name` VARCHAR(255) NOT NULL,
  `city` VARCHAR(255) NOT NULL,
  `amenities` TEXT,
  `ratings` DECIMAL(2, 1),
  `description` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert sample data into hotels with the updated description column
INSERT INTO `hotels` (`hotelid`, `hotel_name`, `city`, `amenities`, `ratings`, `description`) VALUES
(1, 'Maple Hermitage', 'Chennai', '24*7 Room Service\r\n Fine-Dining\r\n Free WiFi\r\n CCTV Surveillance\r\n Swimming Pool', 4.8, 'Spacious 2BHK suites ideal for families, offering two bedrooms, a kitchenette, and a living room. Accommodates up to 4 guests comfortably.'),
(2, 'The Park Chennai', 'Chennai', '24*7 Room Service\r\n Fine-Dining\r\n Free WiFi\r\n CCTV Surveillance\r\n Swimming Pool', 5, 'Luxurious 1BHK and 2BHK suites with elegant furnishings and modern amenities. 1BHK suites accommodate up to 2 guests, while 2BHK suites can accommodate up to 4 guests.'),
(3, 'Grand Residence', 'Chennai', '24*7 Room Service\r\n Fine-Dining\r\n Free WiFi\r\n CCTV Surveillance\r\n Swimming Pool', 4.7, 'Comfortable stays with modern amenities. 1BHK suites available, accommodating up to 2 guests.'),
-- Add additional hotel inserts here following the same pattern
(4, 'Country Inn Panjim Goa', 'Goa', 'Airport transfer Valet parking Free Wi-Fi in all rooms! Front desk [24-hour] Fitness center Sauna Check-in/out [express] BBQ facilities', 5, 'Scenic 1BHK rooms with stunning sea views. Accommodates up to 2 guests.'),
(5, 'Woodpegger By The Beach', 'Goa', 'Airport transfer Pets allowed Car park Free Wi-Fi in all rooms! Fitness center Luggage storage Check-in/out [private] Check-in [24-hour]', 5, 'Eco-friendly 2BHK cottages set in a serene location. Each cottage can accommodate up to 4 guests.'),
(6, 'Stone Wood Beach Resort and Club, Vagator Beach', 'Goa', 'Car park Free Wi-Fi in all rooms! Front desk [24-hour] Swimming pool [indoor] Game room Laundry service Nightclub Restaurants', 5, 'Spacious 2BHK cottages with modern amenities. Ideal for families or groups, accommodating up to 6 guests.'),
(7, 'Tunga International', 'Goa', '24*7 Room Service\r\n Fine-Dining\r\n Free WiFi\r\n CCTV Surveillance\r\n Great Views', 5, 'Comfortable 1BHK suites with scenic views. Accommodates up to 2 guests.'),

(8, 'The Gawaling ladakh', 'Ladakh', 'Airport transfer\r\n Car park\r\n Free Wi-Fi in all rooms!\r\n Front desk [24-hour]\r\n Luggage storage\r\n Breakfast [free]\r\n Contactless check-in/out\r\n Restaurants', 4.7, 'Traditional 1BHK stays encapsulating the local culture, set against the backdrop of majestic mountains.'),
(9, 'The Grand Dragon Hotel', 'Ladakh', ' Front desk [24-hour]\r\n Airport transfer\r\n Bicycle rental\r\n Valet parking\r\n Kids club\r\n Fitness center\r\n Shuttle service\r\n Free Wi-Fi in all rooms!', 4.7, 'Traditional 1BHK stays encapsulating the local culture, set against the backdrop of majestic mountains.'),
(10, 'Casa Galwan ', 'Ladakh', ' Front desk [24-hour]\r\n Airport transfer\r\n Pets allowed\r\n Car park\r\n Bicycles\r\n Free Wi-Fi in all rooms!\r\n Check-in/out [private]\r\n Breakfast [free]', 4.7, 'Traditional 1BHK stays encapsulating the local culture, set against the backdrop of majestic mountains.'),
(11, 'Agling Resort', 'Ladakh', 'Car park\r\n Free Wi-Fi in all rooms!\r\n Front desk [24-hour]\r\n Check-in/out [private]\r\n Laundry service\r\n Security [24-hour]\r\n Daily housekeeping\r\n Free face masks', 4.7, 'Traditional 1BHK stays encapsulating the local culture, set against the backdrop of majestic mountains.'),

(12, 'Holiday Inn Express Pune Hinjewadi', 'Pune', 'Front desk [24-hour]\nAirport transfer\nCar park\nFree Wi-Fi in all rooms!\nGolf course [on-site]\nFitness center\nCheck-in/out [express]\nLuggage storage', 5, 'Modern hotel with studio and 2BHK options, catering to business and leisure with a golf course on-site.'),
(13, 'Hotel Parc Estique', 'Pune', 'Airport transfer\nValet parking\nShuttle service\nFront desk [24-hour]\nSwimming pool [outdoor]\nFitness center\nCheck-in/out [express]\nLuggage storage', 5, 'Boutique hotel offering luxury suites for families and corporate guests, featuring an outdoor pool.'),
(14, 'Radisson Blu Pune Hinjawadi', 'Pune', 'Front desk [24-hour]\nAirport transfer\nValet parking\nShuttle service\nSwimming pool [indoor]\nFitness center\nFree Wi-Fi in all rooms!\nCheck-in/out [express]', 5, '5-star accommodation with a variety of room types, ideal for hosting events and business meetings.'),
(15, 'Ginger Hotel Pune - Wakad', 'Pune', 'Airport transfer\nCar park\nFree Wi-Fi in all rooms!\nFront desk [24-hour]\nContactless check-in/out\nFitness center\nCoffee shop\nBar', 5, 'Affordable yet stylish, offering smartly designed rooms for the savvy traveler.'),
(16, 'Ritz Carlton', 'Pune', '24*7 Room Service\nFine-Dining\nFree WiFi\nCCTV Surveillance\nSwimming Pool', 5, 'Premier luxury with 2BHK and 3BHK suites, boasting world-class dining and a rooftop pool.'),
(17, 'Aralia International Airport, Mumbai', 'Mumbai', 'Front desk [24-hour]\nAirport transfer\nValet parking\nFree Wi-Fi in all rooms!\nCheck-in/out [express]\nLuggage storage\nRestaurants\nCoffee shop', 3, 'Conveniently located near the airport with comfortable rooms, perfect for layovers and short stays. Offers studio and 1BHK accommodations for up to 2 guests.'),
(18, 'Hotel Parle International', 'Mumbai', 'Front desk [24-hour]\nAirport transfer\nCar park\nShuttle service\nFitness center\nFree Wi-Fi in all rooms!\nLuggage storage\nCash withdrawal', 3, 'A business hotel with multi-functional spaces for meetings and events. Features studio and 1BHK accommodations, suitable for up to 2 guests.'),
(19, 'Hotel Cliffton', 'Mumbai', 'Front desk [24-hour]\nAirport transfer\nValet parking\nFree Wi-Fi in all rooms!\nCheck-in/out [express]\nLuggage storage\nBreakfast [free]\nRestaurants', 3, 'Affordable luxury in the heart of the city, featuring spacious studio and 1BHK accommodations for families and couples, accommodating up to 2 guests.'),
(20, 'Umaid Haveli Hotel and Resorts', 'Rajasthan', 'Front desk [24-hour]\nAirport transfer\nValet parking\nFree Wi-Fi in all rooms!\nSwimming pool [outdoor]\nTennis court\nCheck-in/out [express]\nBBQ facilities', 5, 'Heritage property with royal 2BHK suites blending traditional architecture with modern comforts. Each suite can accommodate up to 4 guests.'),
(21, 'Laxmi Palace Heritage Boutique Hotel', 'Rajasthan', 'Front desk [24-hour]\nAirport transfer\nBicycle rental\nValet parking\nSwimming pool [outdoor]\nShuttle service\nFree Wi-Fi in all rooms!\nLuggage storage', 4.8, 'A boutique hotel offering an authentic Rajasthani experience with beautifully decorated rooms. Provides spacious studio and 1BHK accommodations, suitable for up to 2 guests.'),
(22, 'Hilton Jaipur', 'Rajasthan', 'Front desk [24-hour]\nAirport transfer\nValet parking\nSwimming pool [outdoor]\nFitness center\nFree Wi-Fi in all rooms!\nBar\nCheck-in/out [express]', 5, 'Luxury hotel with elegant rooms and suites, renowned for its hospitality and fine dining options. Offers studio and 1BHK accommodations, ideal for up to 2 guests.'),
(23, 'The Orchard Greens Resort', 'Manali', ' Front desk [24-hour]\r\n Airport transfer\r\n Car park\r\n Free Wi-Fi in all rooms!\r\n Swimming pool [outdoor]\r\n Golf course [on-site]\r\n BBQ facilities\r\n Luggage storage\n Great Views', 5, 'Nestled amidst the snow-capped peaks, offering Gothic revival architecture villas and a stunning outdoor pool. Features spacious 1BHK and 2BHK accommodations, suitable for up to 4 guests.'),
(24, 'The Himalayan', 'Manali', 'Front desk [24-hour]\nAirport transfer\nSwimming pool [outdoor]\nFree Wi-Fi in all rooms!\nSpa\nSauna\nBar\nCheck-in/out [express]', 4.8, 'Nestled amidst the snow-capped peaks, offering Gothic revival architecture villas and a stunning outdoor pool. Features luxurious 1BHK accommodations, perfect for up to 2 guests.'),
(25, 'Manuallaya The Resort Spa', 'Manali', 'Front desk [24-hour]\nAirport transfer\nSwimming pool [indoor]\nFree Wi-Fi in all rooms!\nSpa\nFitness center\nRestaurant\nGame room', 4.7, 'A serene retreat with luxurious spa services, indoor pool, and activities for all ages. Provides cozy studio and 1BHK accommodations, suitable for up to 2 guests.'),
(26, 'Honeymoon Inn Manali', 'Manali', 'Front desk [24-hour]\nCar park\nFree Wi-Fi in all rooms!\nGarden\nLibrary\nRestaurant\nCurrency exchange\nLaundry service', 4.5, 'Perfect for couples, offering romantic views, cozy accommodations, and a picturesque garden. Provides comfortable 1BHK accommodations, ideal for up to 2 guests.'),
(27, 'The Orchard Greens Resort and Spa', 'Manali', 'Front desk [24-hour]\nAirport transfer\nSwimming pool [outdoor]\nFree Wi-Fi in all rooms!\nSpa\nFitness center\nRestaurant\nKids club', 4.6, 'Family-friendly resort with spacious rooms, modern spa, and a kids club amidst lush orchards. Features 1BHK accommodations, suitable for up to 2 guests.'),
(28, 'Taj Malabar Resort & Spa, Cochin', 'Kerala', 'Front desk [24-hour]\nSwimming pool [outdoor]\nFree Wi-Fi in all rooms!\nSpa\nFitness center\nWater sports (motorized)\nBar\nAirport transfer', 5, 'Luxurious waterfront retreat offering world-class spa services and a view of the Cochin harbor. Provides spacious 1BHK and 2BHK accommodations, suitable for up to 4 guests.'),
(29, 'The Leela Kovalam', 'Kerala', 'Front desk [24-hour]\nSwimming pool [outdoor]\nFree Wi-Fi in all rooms!\nSpa\nFitness center\nBeach access\nRestaurant\nYoga room', 5, 'India’s only cliff-top beach resort, offering panoramic views of the Kovalam shoreline. Features luxurious 1BHK and 2BHK accommodations, perfect for up to 4 guests.'),
(30, 'Kumarakom Lake Resort', 'Kerala', 'Front desk [24-hour]\nSwimming pool [outdoor]\nFree Wi-Fi in all rooms!\nSpa\nWater sports (non-motorized)\nFitness center\nBar\nRestaurant', 5, 'Award-winning resort on the banks of Vembanad Lake, with luxurious heritage villas and houseboats. Provides spacious 1BHK and 2BHK accommodations, ideal for up to 4 guests.'),
(31, 'Fragrant Nature Kochi', 'Kerala', 'Front desk [24-hour]\nSwimming pool [outdoor]\nFree Wi-Fi in all rooms!\nSpa\nFitness center\nRooftop restaurant\nArt gallery\nLibrary', 4.8, 'Boutique hotel in the heart of Kochi with a blend of traditional and modern architectural elements. Features studio and 1BHK accommodations, suitable for up to 2 guests.'),
(32, 'Mayfair Spa Resort & Casino', 'Sikkim', 'Front desk [24-hour]\nCasino\nSwimming pool [outdoor]\nFree Wi-Fi in all rooms!\nSpa\nFitness center\nBar\nAirport transfer', 5, 'A luxurious retreat nestled in the Himalayas, offering a casino, world-class spa, and outdoor pool. Provides luxurious 1BHK accommodations, perfect for up to 2 guests.'),
(33, 'The Elgin Nor-Khill, Gangtok', 'Sikkim', 'Front desk [24-hour]\nAirport transfer\nFree Wi-Fi in all rooms!\nBar\nRestaurant\nLibrary\nGarden\nLaundry service', 4.7, 'A heritage hotel with traditional Sikkimese hospitality, known for its historical significance and gardens. Features cozy studio and 1BHK accommodations, ideal for up to 2 guests.'),
(34, 'Summit Denzong Hotel & Spa', 'Sikkim', 'Front desk [24-hour]\nAirport transfer\nSwimming pool [indoor]\nFree Wi-Fi in all rooms!\nSpa\nRestaurant\nBar\nConference facilities', 4.5, 'Centrally located in Gangtok, offering a serene spa experience and stunning views of the surrounding mountains. Features comfortable 1BHK accommodations, suitable for up to 2 guests.');
-- Create the login table
CREATE TABLE `login` (
  `usersid` INT(4) NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(50) NOT NULL,
  `lastname` VARCHAR(50) NOT NULL,
  `age` INT(11) NOT NULL,
  `number` BIGINT(30) NOT NULL,
  `gender` VARCHAR(50) NOT NULL,
  `address` VARCHAR(50) NOT NULL,
  `usersEmail` VARCHAR(128) NOT NULL,
  `password` VARCHAR(128) NOT NULL,
  `userAadhar` BIGINT(30) NOT NULL,
  PRIMARY KEY (`usersid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert data into login table
INSERT INTO `login` (`firstname`, `lastname`, `age`, `number`, `gender`, `address`, `usersEmail`, `password`, `userAadhar`) VALUES
('Roshni', 'Parashar', 21, 7898784041, 'F', 'Gwalior', 'roshni@gmail.com', '54321', 254785421654),
('Parul', 'Gupta', 21, 7865243041, 'F', 'Bhind', 'parul@gmail.com', '12345', 586974421654);

-- Create the city_packages table
CREATE TABLE `city_packages` (
  `package_id` INT AUTO_INCREMENT PRIMARY KEY,
  `city` VARCHAR(255) NOT NULL,
  `region` VARCHAR(255) NOT NULL,
  `season` VARCHAR(255) NOT NULL,
  `days` INT(2) NOT NULL,
  `package_name` VARCHAR(255) NOT NULL,
  `package_description` TEXT,
  `package_price` BIGINT(50) NOT NULL,
  `hotelid` INT,  -- Foreign key to reference the hotel id from the hotels table
  `image_path` VARCHAR(255), -- Column to store the path to the image file
  FOREIGN KEY (`hotelid`) REFERENCES `hotels`(`hotelid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert data into city_packages table with image paths
INSERT INTO `city_packages` (`city`, `region`, `days`, `package_name`, `package_description`, `package_price`, `hotelid`, `image_path`) VALUES
('Chennai', 'South', 4,  'South India Church Pilgrimage Getaway', 'Discover the rich cultural heritage of Chennai in 4 days.', 38000, 1, 'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Y2hlbm5haXxlbnwwfHwwfHx8MA%3D%3D'),
('Chennai', 'South', 5, 'Chennai Adventure Tour', 'Embark on an adventurous journey through Chennai and its surroundings.', 42000, 2, 'https://images.unsplash.com/photo-1616843413587-9e3a37f7bbd8?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2hlbm5haXxlbnwwfHwwfHx8MA%3D%3D'),
('Chennai', 'South', 4,' Chennai to Yelagiri Tour Package', 'Discover the rich cultural heritage of Chennai in 4 days.', 32000, 3, 'https://images.unsplash.com/photo-1605461819400-e0aa36bc6a1d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDB8fGNoZW5uYWl8ZW58MHx8MHx8fDA%3D'),

('Ladakh', 'North',  5,  'Ladakh Saver - Land Only', 'Embark on an adventurous journey through Chennai and its surroundings.', 42000, 8, 'https://plus.unsplash.com/premium_photo-1661949303004-bab6b7a82912?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8bGFkYWtofGVufDB8fDB8fHww'),
('Ladakh', 'North',  7,  'Captivating Ladakh', 'Experience the breathtaking beauty of Ladakh in a 7-day expedition.', 55000, 9, 'https://plus.unsplash.com/premium_photo-1661962344178-19930ba15492?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8bGFkYWtofGVufDB8fDB8fHww'),
('Ladakh', 'North',  5,  'Beautiful Leh with Nubra', 'Embark on an adventurous journey through Chennai and its surroundings.', 38000, 10, 'https://images.unsplash.com/photo-1662203461324-c85a1e9c39c4?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bGFkYWtoJTIwaG90ZWxzfGVufDB8fDB8fHww'),
('Ladakh', 'North',  7,  'Expedition', 'Experience the breathtaking beauty of Ladakh in a 7-day expedition.', 45000, 11, 'https://images.unsplash.com/photo-1505585310466-e79c7e18a05b?q=80&w=3295&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),

('Manali', 'North', 6,  'Manali Adventure Retreat', 'Escape to the serene hills of Manali for an adventurous retreat.', 48000, 23, 'https://images.unsplash.com/photo-1578564969231-039947801495?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('Manali', 'North', 4,  'Manali Solang Valley Kullu ', 'Discover the rich cultural heritage of Manali in 4 days.', 52000, 25, 'https://images.unsplash.com/photo-1654057385851-92edb66acf3f?q=80&w=3000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
( 'Manali', 'North', 7,  'Spiti - Group Tour', 'Escape to the serene hills of Manali for an adventurous retreat.', 42000, 24, 'https://images.unsplash.com/photo-1571677465484-2dd540924245?q=80&w=3324&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
( 'Manali', 'North', 6,  'Himachal Senior Citizen Special', 'Embark on an adventurous journey through Manali and its surroundings.', 52000, 26, 'https://images.unsplash.com/photo-1621494926238-2ff657276ca3?q=80&w=3000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
( 'Manali', 'North', 6,  'Himachal Evergreen', 'Escape to the serene hills of Manali for an adventurous retreat.', 55000, 27, 'https://images.unsplash.com/photo-1516406742981-2b7d67ec4ae8?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),

( 'Goa', 'West', 5,  'Goa Beach Getaway', 'Relax and rejuvenate on the pristine beaches of Goa.', 45000, 4, 'https://images.unsplash.com/photo-1581892197913-fd2e407e698a?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Z29hfGVufDB8fDB8fHww'),
( 'Goa', 'West', 4, 'Budget Friendly Goa Package', 'Discover the rich cultural heritage of goa in 4 days', 45000, 5, 'https://images.unsplash.com/photo-1587922546307-776227941871?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8Z29hfGVufDB8fDB8fHww'),
( 'Goa', 'West', 5,  'Tropical Paradise Goa Adventure', 'Embark on an adventurous journey through goa and its surroundings.', 45000, 6, 'https://images.unsplash.com/photo-1623815616454-f4de13de2634?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjR8fGdvYXxlbnwwfHwwfHx8MA%3D%3D'),
('Goa', 'West', 5,  'Beach Getaway', 'Relax and rejuvenate on the pristine beaches of Goa.', 45000, 7, 'https://plus.unsplash.com/premium_photo-1664121799972-98e5aa03d31b?q=80&w=3174&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),

( 'Mumbai', 'West', 3,  'Mumbai City Tour', 'Explore the bustling city of Mumbai and its iconic landmarks.', 38000, 17, 'https://images.unsplash.com/photo-1595658658481-d53d3f999875?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fG11bWJhaXxlbnwwfHwwfHx8MA%3D%3D'),
( 'Mumbai', 'West', 4,  'Mumbai City of Dreams Package', 'Embark on an adventurous journey through Mumbai and its surroundings..', 38000, 18, 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fG11bWJhaXxlbnwwfHwwfHx8MA%3D%3D'),
( 'Mumbai', 'West', 6,  'Aamchi Mumbai', 'Explore the bustling city of Mumbai and its iconic landmarks.', 38000, 19, 'https://images.unsplash.com/photo-1591014141178-02091240f1c6?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fG11bWJhaXxlbnwwfHwwfHx8MA%3D%3D'),

('Rajasthan', 'West', 7,  'Classical Rajasthan With Udaipur', 'Discover the rich heritage and cultural wonders of Jaipur.', 27000, 20, 'https://images.unsplash.com/photo-1587295656906-b06dca8f2340?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cmFqYXN0aGFufGVufDB8fDB8fHww'),
('Rajasthan', 'West', 5,  'Grand Tour Of Rajasthan', 'Embark on an adventurous journey through Rajasthan and its surroundings.', 25000, 21, 'https://images.unsplash.com/photo-1586612438666-ffd0ae97ad36?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8cmFqYXN0aGFufGVufDB8fDB8fHww'),
('Rajasthan', 'West', 4,  'Rajasthan Royal Dessert Tour', 'Discover the rich heritage and cultural wonders of Jaipur.', 43000, 22, 'https://images.unsplash.com/photo-1598190896090-9dc5c70361d8?q=80&w=3328&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),

( 'Kerala', 'South', 4,  'Kerala Blissful Retreat', 'Discover the rich heritage and cultural wonders of kerala.', 52000, 28, 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8S0VSQUxBfGVufDB8fDB8fHww'),
( 'Kerala', 'South', 5,  'Reverting Kerala', 'Embark on an adventurous journey through Kerala and its surroundings.', 48000, 29, 'https://images.unsplash.com/photo-1590050752117-238cb0fb12b1?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8S0VSQUxBfGVufDB8fDB8fHww'),
( 'Kerala', 'South', 6,  'Relaxing Kerala ( Premium)', 'Discover the rich heritage and cultural wonders of Kerala.', 22000, 30, 'https://images.unsplash.com/photo-1593693397690-362cb9666fc2?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8S0VSQUxBfGVufDB8fDB8fHww'),
( 'Kerala', 'South', 4,  'Verdant Kerala ( Premium)', 'iscover the rich cultural heritage of Kerala in 4 days.', 36000, 31, 'https://images.unsplash.com/photo-1601220840366-d29aedc7e987?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mzl8fEtFUkFMQXxlbnwwfHwwfHx8MA%3D%3D'),

( 'Sikkim', 'North', 7,  'A Taste Of The Hills 4 Nights', 'Escape to the serene hills of Sikkim for an adventurous retreat.', 48000, 32, 'https://images.unsplash.com/photo-1562413181-9013f9846bff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8c2lra2ltfGVufDB8fDB8fHww'),
( 'Sikkim', 'North', 6,  'Darjeeling & Gangtok Couple Special', 'Relax and rejuvenate on the pristine beaches of Sikkim.', 52000, 33, 'https://plus.unsplash.com/premium_photo-1697730418140-064a5b6c2e17?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8c2lra2ltfGVufDB8fDB8fHww'),
( 'Sikkim', 'North', 5,  'Glimpse Of Himalayan Kingdom', 'Discover the rich heritage and cultural wonders of Sikkim.', 30000, 34, 'https://images.unsplash.com/photo-1515747802812-e9226ae7e01b?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fHNpa2tpbXxlbnwwfHwwfHx8MA%3D%3D'),

( 'Pune', 'North', 6, 'Immerse In The Sanctity Of Tuljapur', 'Embark on an adventurous journey through Pune and its surroundings.', 25000, 12, 'https://images.unsplash.com/photo-1608019425630-bec4810ccb60?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8cHVuZXxlbnwwfHwwfHx8MA%3D%3D'),
( 'Pune', 'North', 2, 'Package	Duration	Starting Price	DetaiBLonavala & Khandala', 'Discover the rich heritage and cultural wonders of Pune.', 20000, 13, 'https://images.unsplash.com/photo-1598090216740-eb040d8c3f82?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fHB1bmV8ZW58MHx8MHx8fDA%3D'),
( 'Pune', 'North', 6, 'Mahabaleshwar & Panchgani Tour in 3 Days', 'Discover the rich heritage and cultural wonders of Pune.', 52000, 14, 'https://images.unsplash.com/photo-1571592311284-20be12500bd1?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fHB1bmV8ZW58MHx8MHx8fDA%3D');


CREATE TABLE `bookings` (
    `booking_id` INT AUTO_INCREMENT PRIMARY KEY,
    `package_id` INT,
    `name` VARCHAR(100),
    `email` VARCHAR(100),
    `contact_number` VARCHAR(20),
    `number_of_tourists` INT,
    `date` DATE,
    `total_amount` DECIMAL(10, 2), -- New column to store the total amount
    `payment_id` INT,
    FOREIGN KEY (`package_id`) REFERENCES `city_packages`(`package_id`)
);




-- Create the reviews table
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reviewer_name VARCHAR(100) NOT NULL,
    review_content TEXT NOT NULL,
    rating INT NOT NULL,
    review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  
); 

-- Insert dummy data into reviews table with city_id
INSERT INTO reviews (reviewer_name, review_content, rating,  review_date) VALUES
('John Doe', 'Had a fantastic experience! Everything was perfect from start to finish.', 5, '2024-04-01 10:00:00'),
('Alice Smith', 'The hotel was lovely and the staff were very friendly. Would definitely recommend!', 4, '2024-04-02 12:00:00'),
('Emma Johnson', 'The package tour exceeded my expectations. Breathtaking views and great guides.', 5,  '2024-04-03 15:00:00'),
('Sarah Brown', 'The trip was amazing I can''t wait to book with you again next year.', 5, '2024-04-04 09:00:00');


ALTER TABLE `bookings`
ADD COLUMN `mode_of_payment` VARCHAR(20) AFTER `total_amount`;
