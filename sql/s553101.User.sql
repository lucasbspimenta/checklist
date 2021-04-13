/*    ==Parâmetros de Script==

    Versão do Servidor de Origem : SQL Server 2016 (13.0.1742)
    Edição do Mecanismo de Banco de Dados de Origem : Microsoft SQL Server Enterprise Edition
    Tipo do Mecanismo de Banco de Dados de Origem : SQL Server Autônomo

    Versão do Servidor de Destino : SQL Server 2017
    Edição de Mecanismo de Banco de Dados de Destino : Microsoft SQL Server Standard Edition
    Tipo de Mecanismo de Banco de Dados de Destino : SQL Server Autônomo
*/

USE [master] 

GO 

  

/* For security reasons the login is created disabled and with a random password. */ 

/****** Object:  Login [s553101]    Script Date: 13/04/2021 14:36:40 ******/ 

CREATE LOGIN [s553101] WITH PASSWORD=N'FoA9C5Sqrc', DEFAULT_DATABASE=[master], DEFAULT_LANGUAGE=[us_english], CHECK_EXPIRATION=OFF, CHECK_POLICY=OFF 

GO 

  

ALTER LOGIN [s553101] DISABLE 

GO 

  

ALTER SERVER ROLE [bulkadmin] ADD MEMBER [s553101] 

GO 

USE [ATENDIMENTO]
GO
/****** Object:  User [s553101]    Script Date: 13/04/2021 14:32:01 ******/
IF NOT EXISTS (SELECT * FROM sys.database_principals WHERE name = N's553101')
CREATE USER [s553101] FOR LOGIN [s553101] WITH DEFAULT_SCHEMA=[dbo]
GO
ALTER ROLE [db_owner] ADD MEMBER [s553101]
GO
