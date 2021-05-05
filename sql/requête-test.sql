SELECT c.Code, 
    c.Name,
    c.Continent,
    c.Region,
    c.SurfaceArea,
    c.IndepYear,
    c.Population,
    c.LifeExpectancy 
FROM country c 
JOIN countrylanguage l 
ON c.code = l.CountryCode 
WHERE l.language = 'French';