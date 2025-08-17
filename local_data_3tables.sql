--
-- PostgreSQL database dump
--

-- Dumped from database version 17.5 (Debian 17.5-1.pgdg130+1)
-- Dumped by pg_dump version 17.5 (Debian 17.5-1.pgdg130+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: restaurants; Type: TABLE DATA; Schema: public; Owner: sail
--

INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (1, '炭火焼肉 炎庵（ほのおあん）', '厳選された和牛を炭火でじっくりと。落ち着いた空間で大人の焼肉体験を。', '京都府京都市中京区河原町通三条上る', '075-123-4567', '月～金: 17:00～23:00, 土日祝: 12:00～23:00', 'images/photo-1.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (2, '七輪亭 牛炎（ぎゅうえん）', '気軽に立ち寄れる大衆焼肉店。新鮮なホルモンと特製タレが自慢。', '京都府京都市下京区烏丸通七条下る', '075-987-6543', '全日: 17:00～24:00', 'images/photo-2.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (3, '京焼肉 粋月（すいげつ）', '京都の風情を感じる町家で、こだわり抜いた京の和牛を堪能。', '京都府京都市東山区祇園町南側', '075-234-5678', '火～日: 18:00～23:00 (月曜定休)', 'images/photo-3.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (4, '焼肉 和（なごみ） 烏丸御池', '家族や友人とゆったり過ごせる、アットホームな雰囲気の焼肉店。', '京都府京都市中京区両替町通御池下る', '075-345-6789', '全日: 17:30～23:30', 'images/photo-4.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (5, '肉匠 大志（たいし）', '職人の技が光る希少部位の数々。肉好きにはたまらないラインナップ。', '京都府京都市伏見区桃山町山ノ下', '075-876-5432', '月～金: 17:00～22:00, 土日祝: 12:00～22:00', 'images/photo-5.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (6, '焼肉酒場 煙々（えんえん）', '煙もくもく、活気あふれる空間で、美味しい焼肉と美酒を。', '京都府京都市左京区田中里ノ内町', '075-456-7890', '全日: 18:00～翌1:00', 'images/photo-6.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (7, 'ホルモン酒場 満腹', '種類豊富な新鮮ホルモンが自慢。特製ダレでご飯が進む！', '京都府京都市南区東九条西山町', '075-567-8901', '全日: 16:00～23:00', 'images/photo-7.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (8, 'プレミアム焼肉 雅（みやび）', '特別な日を彩る、上質な空間と最高級の和牛を。', '京都府京都市中京区木屋町通三条下る', '075-678-9012', '全日: 17:00～23:00', 'images/photo-8.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (9, '焼肉亭 大黒（だいこく）', '創業50年の老舗。秘伝のタレと変わらぬ味が人気の理由。', '京都府京都市北区紫野泉堂町', '075-789-0123', '火～日: 17:00～22:00 (月曜定休)', 'images/photo-9.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (10, '焼肉ダイニング 翠（すい）', '選び抜かれた銘柄牛とワインのマリアージュ。洗練された大人の空間。', '京都府京都市上京区今出川通室町西入', '075-890-1234', '全日: 17:30～23:00', 'images/photo-10.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (11, '炙り家 源（げん）', 'A5ランク和牛の炙り寿司は必食。炭火で炙る逸品揃い。', '京都府京都市下京区四条通高倉西入', '075-012-3456', '全日: 17:00～24:00', 'images/photo-11.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (12, '焼肉物語 炎の舞', '炎が舞い上がるパフォーマンスも楽しい！エンターテイメント性あふれる焼肉店。', '京都府京都市中京区河原町通蛸薬師下る', '075-135-7924', '月～金: 17:00～23:00, 土日祝: 12:00～23:00', 'images/photo-12.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (13, '黒毛和牛専門 匠（たくみ）', '目利きが選んだ最高級の黒毛和牛のみを使用。とろける旨みを堪能。', '京都府京都市東山区縄手通四条上る', '075-246-8013', '全日: 17:00～23:00', 'images/photo-13.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (14, 'ホルモン処 よろこび', 'レトロな雰囲気で賑わうホルモン専門店。希少部位も豊富。', '京都府京都市西京区桂御所町', '075-369-1245', '全日: 18:00～24:00', 'images/photo-14.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.restaurants (id, name, description, address, telephone, operating_hours, image_url, created_at, updated_at) VALUES (15, '焼肉と釜飯 香炉（こうろ）', '焼肉の後に〆は釜飯で。こだわりの逸品料理も楽しめる。', '京都府京都市中京区新町通錦小路上る', '075-470-3698', '火～日: 17:00～23:00 (月曜定休)', 'images/photo-15.png', '2025-08-17 11:53:59', '2025-08-17 11:53:59');


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: sail
--

INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES (1, 'Test User', 'test@example.com', '2025-08-17 11:53:59', '$2y$12$9LfPoBboCDTuL7E46s9Tyu3xxzaUzNEAPDZbZDqSP0EXroAHy1BVm', 'lSks4h0jTU', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES (2, 'Ms. Destiney Rutherford', 'laurine62@example.net', '2025-08-17 11:53:59', '$2y$12$9LfPoBboCDTuL7E46s9Tyu3xxzaUzNEAPDZbZDqSP0EXroAHy1BVm', 'YX6dfTfyEV', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES (3, 'Miss Alba Schmitt', 'tavares71@example.com', '2025-08-17 11:53:59', '$2y$12$9LfPoBboCDTuL7E46s9Tyu3xxzaUzNEAPDZbZDqSP0EXroAHy1BVm', 'c3El9UGctT', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES (4, 'Kailyn Kassulke', 'franecki.isabel@example.com', '2025-08-17 11:53:59', '$2y$12$9LfPoBboCDTuL7E46s9Tyu3xxzaUzNEAPDZbZDqSP0EXroAHy1BVm', 'kg5bSUSPlm', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES (5, 'Lucious Schumm', 'granville.jones@example.com', '2025-08-17 11:53:59', '$2y$12$9LfPoBboCDTuL7E46s9Tyu3xxzaUzNEAPDZbZDqSP0EXroAHy1BVm', 'HaviCp6u58', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES (6, 'Theo Labadie V', 'iblock@example.com', '2025-08-17 11:53:59', '$2y$12$9LfPoBboCDTuL7E46s9Tyu3xxzaUzNEAPDZbZDqSP0EXroAHy1BVm', 'AnGyaZFb8R', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES (7, 'Landen Jacobi', 'kianna01@example.com', '2025-08-17 11:53:59', '$2y$12$9LfPoBboCDTuL7E46s9Tyu3xxzaUzNEAPDZbZDqSP0EXroAHy1BVm', 'lnCzdk3OdI', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES (8, 'Arvid Dickinson', 'bwitting@example.org', '2025-08-17 11:53:59', '$2y$12$9LfPoBboCDTuL7E46s9Tyu3xxzaUzNEAPDZbZDqSP0EXroAHy1BVm', 'Fnhhz5A1Dd', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES (9, 'Elias Schultz', 'johnny.schowalter@example.org', '2025-08-17 11:53:59', '$2y$12$9LfPoBboCDTuL7E46s9Tyu3xxzaUzNEAPDZbZDqSP0EXroAHy1BVm', 'f7GJbW0VVA', '2025-08-17 11:53:59', '2025-08-17 11:53:59');


--
-- Data for Name: reviews; Type: TABLE DATA; Schema: public; Owner: sail
--

INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (1, 2, 8, 5, '雰囲気が良くて、ゆっくり食事ができました。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (2, 6, 4, 5, '提供が早くて助かりました。味も満足です。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (3, 9, 8, 4, '雰囲気が良くて、ゆっくり食事ができました。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (4, 2, 2, 5, '少々お値段は張りますが、最高の体験でした。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (5, 8, 14, 5, '肉の質が最高でした。また行きたいです。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (6, 7, 10, 3, '普通に美味しいですが、特筆すべき点はありません。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (7, 3, 9, 3, '普通に美味しいですが、特筆すべき点はありません。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (8, 3, 2, 5, 'まさに至福のひととき。こんなお店を探していました！完璧です！', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (9, 1, 15, 1, '肉が硬く、脂っこすぎました。二度と行きません。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (10, 1, 2, 5, '雰囲気が良くて、ゆっくり食事ができました。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (11, 9, 9, 3, 'コスパは良いと思います。気軽に利用できます。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (12, 3, 10, 2, '値段の割に量が少なかったです。不満。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (13, 7, 13, 4, '予約が取りにくいのが難点ですが、納得の味です。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (14, 1, 13, 3, '可もなく不可もなく、といった感じです。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (15, 2, 15, 1, '期待しすぎたのか、思ったほどではなかったです。再訪はないでしょう。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (16, 2, 11, 4, '肉の質が最高でした。また行きたいです。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (17, 1, 12, 2, '期待しすぎたのか、思ったほどではなかったです。再訪はないでしょう。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (18, 6, 13, 2, '値段の割に量が少なかったです。不満。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (19, 5, 2, 1, '清潔感がなく、残念な気持ちになりました。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (20, 5, 12, 4, 'まさに至福のひととき。こんなお店を探していました！完璧です！', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (21, 5, 5, 2, '煙がひどく、服に匂いがつきすぎました。改善を求めます。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (22, 3, 15, 3, 'コスパは良いと思います。気軽に利用できます。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (23, 2, 5, 5, 'とても美味しかったです！店員さんも親切でした。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (24, 1, 4, 3, '悪くはないですが、感動はありませんでした。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (25, 6, 11, 5, '雰囲気が良くて、ゆっくり食事ができました。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (26, 1, 3, 4, '雰囲気が良くて、ゆっくり食事ができました。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (27, 9, 14, 5, '予約が取りにくいのが難点ですが、納得の味です。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (28, 3, 11, 1, '煙がひどく、服に匂いがつきすぎました。改善を求めます。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (29, 7, 1, 3, '可もなく不可もなく、といった感じです。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (30, 7, 12, 3, 'コスパは良いと思います。気軽に利用できます。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (31, 7, 7, 1, '値段の割に量が少なかったです。不満。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (32, 9, 5, 2, '期待しすぎたのか、思ったほどではなかったです。再訪はないでしょう。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (33, 5, 9, 5, '雰囲気が良くて、ゆっくり食事ができました。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (34, 5, 6, 5, '提供が早くて助かりました。味も満足です。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (35, 2, 7, 3, '悪くはないですが、感動はありませんでした。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (36, 1, 1, 2, '煙がひどく、服に匂いがつきすぎました。改善を求めます。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (37, 8, 7, 5, '肉の質が最高でした。また行きたいです。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (38, 3, 3, 2, '値段の割に量が少なかったです。不満。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (39, 8, 4, 3, 'コスパは良いと思います。気軽に利用できます。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');
INSERT INTO public.reviews (id, user_id, restaurant_id, rating, comment, created_at, updated_at) VALUES (40, 1, 5, 3, '悪くはないですが、感動はありませんでした。', '2025-08-17 11:53:59', '2025-08-17 11:53:59');


--
-- Name: restaurants_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.restaurants_id_seq', 15, true);


--
-- Name: reviews_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.reviews_id_seq', 40, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.users_id_seq', 9, true);


--
-- PostgreSQL database dump complete
--

