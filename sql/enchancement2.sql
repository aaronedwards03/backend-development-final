/* Writing SQL Statements */
/* Step 1 */
INSERT INTO clients 
VALUES
(
    DEFAULT,
    "Tony",
    "Stark",
    "tony@starkent.com",
    "Iam1ronM@n",
    DEFAULT,
    "I am the real Ironman"
);

/* Step 2 */
UPDATE clients
SET clientLevel = 3
WHERE clientFirstname = "Tony" && clientLastName = "Stark";

/* Step 3 */
UPDATE inventory
SET invDescription = replace(invDescription, "small interior", "spacious interior")
WHERE invMake = "GM" && invModel = "Hummer";

/* Step 4 */
SELECT inventory.invModel,  carclassification.classificationName
FROM inventory
INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId
WHERE classificationName = "SUV";

/* Step 5 */
DELETE FROM inventory
WHERE invMake = "Jeep" && invModel = "Wrangler";

/* Step 6 */ 
UPDATE inventory
SET invImage = CONCAT("/phpmotors", invImage) && invThumbnail = CONCAT("/phpmotors", invThumbnail);