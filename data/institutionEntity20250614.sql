-- Adminer 5.3.0 PostgreSQL 16.9 dump

\connect "marart";

DROP TABLE IF EXISTS "institution_entity";
CREATE TABLE "public"."institution_entity" (
    "id" uuid DEFAULT uuid_generate_v4() NOT NULL,
    "name" character varying(80) NOT NULL,
    "shortName" character varying(40) NOT NULL,
    "icon" character varying(25) NOT NULL,
    "holder" character varying(80) NOT NULL,
    "urlEntity" character varying(60) NOT NULL,
    "urlService" character varying(60),
    "createdAt" timestamp DEFAULT now() NOT NULL,
    "updatedAt" timestamp DEFAULT now() NOT NULL,
    "deletedAt" timestamp,
    "typeId" character varying(15),
    "status" boolean DEFAULT true NOT NULL,
    "addressId" uuid NOT NULL,
    CONSTRAINT "PK_a794c1046faa5e8fb127c8902ed" PRIMARY KEY ("id")
)
WITH (oids = false);

CREATE UNIQUE INDEX "UQ_a22ede6486aaac3ee54e7976559" ON public.institution_entity USING btree ("shortName");

CREATE UNIQUE INDEX "UQ_d5ee7ab97e1d37c2be0121fd9b9" ON public.institution_entity USING btree ("addressId");

CREATE UNIQUE INDEX "UQ_f7018dd39911f28a1ee61fc0479" ON public.institution_entity USING btree (name);

INSERT INTO "institution_entity" ("id", "name", "shortName", "icon", "holder", "urlEntity", "urlService", "createdAt", "updatedAt", "deletedAt", "typeId", "status", "addressId") VALUES
('08b74df8-4241-4175-8070-af5a4d4e1933',	'PREFEITURA MUNICIPAL DE ITABORAÍ',	'Prefeitua',	'town-hall',	'MARCELO JANDRE DELAROLI',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'639e53f5-8f64-4885-8d4b-25f879bab92d'),
('0b644cc9-110e-48d4-846d-9661a773a7d4',	'SECRETARIA MUNICIPAL DE HABITAÇÃO E SERVIÇOS SOCIAIS',	'Habitação',	'home-group',	'MARCELO DOS SANTOS FIGUEIREDO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'5a95f56d-f109-4b0a-ac2c-77ed09bea564'),
('155cb3d1-c6da-4e01-9608-570e99561609',	'CRAS AMPLIAÇÃO',	'Ampliação',	'face-agent',	'NÃO INFORMADO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'47b99f09-104e-498e-a666-f186c9900ce9'),
('218636b8-a26e-4e80-9e8b-3c638cb3977e',	'CRAS APOLO',	'Apolo',	'face-agent',	'NÃO INFORMADO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'c9ba9b31-9eb5-4382-a48a-963d53d4d99e'),
('36d20102-a2a0-4d91-a40a-7ce650070096',	'CRAS CABUÇU',	'Cabuçu',	'face-agent',	'NÃO INFORMADO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'964daa50-2dfc-48aa-8f4e-42a9e7303ae6'),
('3a32bb12-8b56-4a9d-84c7-b22fa63231af',	'CRAS ITAMBI',	'Itambi',	'face-agent',	'NÃO INFORMADO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'0fe49e85-c770-4785-b33f-c4b35898ab4a'),
('52134a82-d501-4851-bc99-cb0ee4b27a62',	'CRAS JARDIM IMPERIAL',	'Jd. Imprerial',	'face-agent',	'NÃO INFORMADO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'e2eb60ed-7701-4bca-999d-3493b7dc2e33'),
('5f629726-8f58-49d2-bc9a-329a763c4e31',	'CRAS RETA',	'Reta',	'face-agent',	'NÃO INFORMADO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'5f17a809-d9b6-4d90-9c64-75141311c823'),
('63208962-bc48-4135-bce5-8a75f6868211',	'CRAS VISCONDE',	'Visconde',	'face-agent',	'NÃO INFORMADO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'0621b73e-307e-4c61-b5ce-9a65baf6d4a3'),
('645f6086-b973-4ca8-a3e5-11d1396c8898',	'SECRETARIA MUNICIPAL DE ADMINISTRAÇÃO',	'Administração',	'human-capacity-decrease',	'CELSO ALMEIDA NETTO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'82230d2f-a586-48b1-80a9-76d36cbb45bf'),
('7b51c36c-cda1-4902-b449-8a5833e55e6a',	'SECRETARIA MUNICIPAL DE AGRICULTURA',	'Agricultura',	'tractor-variant',	'ABILIO FLÁVIO DA SILVA PEREIRA',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'a69fb100-3954-4e1c-b571-3054af875dec'),
('7ee64bde-8f1f-4109-9d07-aef192ef4b7a',	'SECRETARIA MUNICIPAL DE COMPRAS, LICITAÇÕES E CONTRATOS',	'Compras, Licitações ',	'cart-variant',	'EDNA FERREIA DA SILVA',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'422bfde1-4d9c-4e49-b127-d7e4de0bcc00'),
('890305ed-1e2d-4f68-8f84-1992d2f50e99',	'SECRETARIA MUNICIPAL DE COMUNICAÇÃO SOCIAL',	'Comunicação Social',	'tooltip-text-outline',	'EDUARDO NOVO TERRA',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'4b54b5cc-5dbd-499d-b0ff-f008070cbc2d'),
('8a880234-2e19-431b-9ddd-2e8cff141009',	'CONTROLADORIA GERAL DO MUNICÍPIO',	'Controladoria',	'cash-multiple',	'NELSON PITTA DE CASTRO NETTO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'c8aeb97b-9863-4b9b-ad80-fe0e7ea3c212'),
('8d54c552-080c-4e02-9148-423842fb849b',	'SECRETARIA MUNICIPAL DE CULTURA',	'Cultura',	'drama-masks',	'ROBERTO MATTOS DA COSTA',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'258fab15-7cd2-4871-805c-8a2b2febc448'),
('8f66272e-48ad-4916-979c-a39b680a5049',	'SECRETARIA MUNICIPAL DE DESENVOLVIMENTO SOCIAL',	'Desenv. Social',	'human-male-female-child',	'MARCOS ANTÔNIO OLIVEIRA DE ARAUJO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'd26c03b9-b57d-4ba9-82fc-1cf7aef7e5aa'),
('969a1614-c69d-4ec1-b9c8-2f07f735155f',	'SECRETARIA MUNICIPAL DE DEFESA CILVIL',	'Defesa Civil',	'car-emergency',	'RICARDO DOS SANTOS NUNES',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'dbefc6b7-7106-43f1-b7ff-96e618901169'),
('984f0aeb-323d-4414-aea3-ed1f6f0247ff',	'SECRETARIA MUNICIPAL DE DESENVOLVIMENTO ECONÔNICO',	'Desenv. Econômico',	'finance',	'LOURIVAL CASULA FILHO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'b234630a-24d6-4e29-8fc5-47eb1d21731f'),
('a69c22ae-217c-41eb-a433-5ad38706c159',	'SECRETARIA MUNICIPAL DE EDUCAÇÃO',	'Educação',	'school-outline',	'MAURICILIO RODRIGUES DE SOUZA',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'becd3daf-f3b9-4384-871c-d0d4cc663956'),
('b95e5d4a-b3bc-41ed-a540-f7c5e5ee08ac',	'SECRETARIA MUNICIPAL DE ESPORTE E LAZER',	'Esporte e Lazer',	'soccer',	'LENON SIMÕES COUTINHO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'e6663220-5c9c-4a65-92d3-7272d472f68c'),
('ba89bf0b-c355-4a0a-87dd-c054029ffb09',	'SECRETARIA MUNICIPAL DE FAZENDA E TECNOLOGIA',	'Fazenda',	'currency-brl',	'ROBERTO ATAÍDE SANTIAGO FONTES',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'75f876af-7c0f-4f14-bfa6-aaa46e9c5742'),
('c305bf10-3967-49c8-9b0a-2fddb7250bf5',	'GABINETE DO PREFEITO',	'Gabinete',	'town-hall',	'DIOGO CABRAL DE ANDRADE',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'de5bb573-df7e-468b-a4cb-a19b3d52065f'),
('c4b8c49b-3db0-4149-8dcd-44b4c2bc67d5',	'SECRETARIA DE GOVERNO',	'Governo',	'town-hall',	'DIOGO CABRAL DE ANDRADE',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'44499834-da19-463b-bd2c-334e012614df'),
('cebfcadc-a824-447c-87a7-a07c44ac74a4',	'OVIDORIA MUNICIPAL',	'Ouvidoria',	'phone-incoming',	'FAUSTINO ALONSO RODRIGUEZ',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'9de62535-c310-48da-a136-d36b8752c4e4'),
('d2aa2881-60e5-4ff8-bcee-5c11e5b2552a',	'ITAPREVI',	'Itaprevi',	'human-handsup',	'JOANA DARK COELHO LAGE DO NASCIMENTO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'22c94aa4-1dd5-4360-a84c-b865e44bdb5e'),
('d372a43c-6262-4f22-b386-b313f7b86de8',	'SECRETARIA MUNICIPAL DE MEIO AMBIENTE E URBANISMO',	'Meio Ambiente',	'tree',	'JHONATAN FERRAREZ DE BARROS',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'b0ba502a-2891-4df4-a672-558781ed6ba6'),
('d3915b57-5f45-4d07-ab19-7d52d6d0ec58',	'SECRETARIA MUNICIPAL DE OBRAS',	'Obras',	'truck-outline',	'ALESSANDRO FERREIRA RODRIGUES',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'bd605248-3746-4b1c-9589-a8d68ff105a4'),
('d5a4994f-a98e-4d36-ab15-9ec2b28677d1',	'SECRETARIA MUNICIPAL DE PLANEJAMENTO',	'Planejamento',	'chart-line',	'SÉRGIO FOSTER PERDIGÃO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'7f71b5cf-5f76-4f02-b6af-4bb69469f8ef'),
('d9556353-5ba7-4091-bb69-a19c87384702',	'PROCURADORIA GERAL DO MUNICÍPIO',	'Procuradoria',	'scale-balance',	'PEDRO RICARDO FERREIRA QUEIROZ DA SILVA',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'860177f8-3bd2-4d5e-8db7-cd166c59b548'),
('dc022e68-c69e-4ced-81e1-873f5141d0be',	'SECRETARIA MUNICIPAL DE SAÚDE',	'Saúde',	'hospital-building',	'SANDRO DOS SANTOS RONQUETTI',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'abf7f258-f9ba-4b26-8e58-a3038f1787a1'),
('ee321c84-6713-453f-9166-544e0932921d',	'SECRETARIA MUNICIPAL DE SEGURANÇA',	'Segurança',	'police-station',	'HEITOR CARVALHAR BALDOW',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'37db3736-5028-4694-bb83-da26be823650'),
('f46c9dc8-29ac-4993-8206-1e563fb1c1fd',	'SECRETARIA MUNICIPAL DE SERVIÇOS PÚBLICOS',	'Serviços Públicos',	'outdoor-lamp',	'UILTON AFONSO VIANA FILHO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'e16ba200-6a4b-41ce-ac76-9dd57b5d5a11'),
('f5b588f8-4d6d-4514-b38f-7ed8ded1efba',	'SECRETARIA MUNICIPAL DE CIÊCIA E INOVAÇÃO',	'Ciência e Inovação',	'microscope',	'RENATO GARCIA DA SILVA',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'06331a4c-0d58-4088-a72a-33cc0266be89'),
('f85e93cd-5d63-4a50-8af7-c92d34fb0ce6',	'SECRETARIA MUNICIPAL DE TRABALHO E RENDA',	'Trabalho e Renda',	'human-male-board-poll',	'EUDNEI DIAS DE OLIVEIRA',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'608bde41-549b-496e-a77c-2ef2dd6500fd'),
('f9c4ac3e-a15d-45a2-a246-a403627c761b',	'SECRETARIA MUNICIPAL DE TRANSPORTES',	'Transporte',	'bus-multiple',	'HEITOR CARVALHAR BALDOW',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'd783c2e0-bf9c-4754-9b95-56b09001b494'),
('fe544356-1c6e-4070-9716-77e66a7e7a4d',	'SECRETARIA MUNICIPAL DE TURISMO E EVENTOS',	'Turismo e Eventos',	'camera-image',	'JOSÉ CARLOS ALMEIDA DE ARAUJO',	'/home/entity',	NULL,	'2024-04-04 12:03:44.38376',	'2024-04-04 12:03:44.38376',	NULL,	NULL,	'1',	'327c062f-13e4-406f-807b-9e6e17be2caf');

ALTER TABLE ONLY "public"."institution_entity" ADD CONSTRAINT "FK_d5ee7ab97e1d37c2be0121fd9b9" FOREIGN KEY ("addressId") REFERENCES address(id) NOT DEFERRABLE;

-- 2025-06-14 14:44:34 UTC
