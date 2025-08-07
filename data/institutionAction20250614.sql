-- Adminer 5.3.0 PostgreSQL 16.9 dump

\connect "marart";

DROP TABLE IF EXISTS "institution_action";
CREATE TABLE "public"."institution_action" (
    "id" uuid DEFAULT uuid_generate_v4() NOT NULL,
    "name" character varying(40) NOT NULL,
    "icon" character varying(25) NOT NULL,
    "description" character varying(80) NOT NULL,
    "urlAction" character varying(60) NOT NULL,
    "urlService" character varying(60),
    "createdAt" timestamp DEFAULT now() NOT NULL,
    "updatedAt" timestamp DEFAULT now() NOT NULL,
    "deletedAt" timestamp,
    CONSTRAINT "PK_30ea4c05ea4d3041775670958fa" PRIMARY KEY ("id")
)
WITH (oids = false);

INSERT INTO "institution_action" ("id", "name", "icon", "description", "urlAction", "urlService", "createdAt", "updatedAt", "deletedAt") VALUES
('a14dc8d3-9827-45f8-bf60-3c72242cd5c9',	'NÃO INFORMADO',	'skull',	'NÃO INFORMADO.',	'/home/',	NULL,	'2024-04-04 15:01:14.47234',	'2024-04-04 15:01:14.47234',	NULL),
('635c4566-ebd8-4904-a514-d6d6d3a77d23',	'Agenda',	'calendar',	'Criar uma agenda para o cidadão.',	'/home/people/schedule',	NULL,	'2024-04-04 15:01:14.47234',	'2024-04-04 15:01:14.47234',	NULL),
('2a0eab80-7514-444c-beb0-2cddf2e7190d',	'Histórico',	'calendarSearch',	'Lista agenda feita pelo cidadão.',	'/home/people/schedule/meetsearch',	NULL,	'2024-04-04 15:01:14.47234',	'2024-04-04 15:01:14.47234',	NULL),
('6f9dae44-8f6f-4ceb-9a16-0e5756c24303',	'Situação',	'accountSearch',	'Informa a situação no programa MCMV.',	'/home/people/search',	NULL,	'2024-04-04 15:01:14.47234',	'2024-04-04 15:01:14.47234',	NULL),
('6729cb8c-b594-4be0-97a4-0e13df9a22e1',	'Cras',	'homeSearch',	'Fornece endereço do CRAS.',	'/home/people/cras',	NULL,	'2024-04-04 15:01:14.47234',	'2024-04-04 15:01:14.47234',	NULL);

-- 2025-06-14 14:46:52 UTC
