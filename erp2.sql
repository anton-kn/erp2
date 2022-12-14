PGDMP     	    ;                 z            erp2 #   14.5 (Ubuntu 14.5-0ubuntu0.22.04.1) #   14.5 (Ubuntu 14.5-0ubuntu0.22.04.1) g    q           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            r           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            s           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            t           1262    25516    erp2    DATABASE     Y   CREATE DATABASE erp2 WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'ru_RU.UTF-8';
    DROP DATABASE erp2;
                postgres    false            ?            1259    25533    course    TABLE     ?   CREATE TABLE public.course (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    date_start date,
    date_end date,
    status integer NOT NULL,
    teacher_id integer NOT NULL,
    rate_med double precision
);
    DROP TABLE public.course;
       public         heap    postgres    false            u           0    0    COLUMN course.name    COMMENT     <   COMMENT ON COLUMN public.course.name IS 'Название';
          public          postgres    false    213            v           0    0    COLUMN course.date_start    COMMENT     G   COMMENT ON COLUMN public.course.date_start IS 'Дата начала';
          public          postgres    false    213            w           0    0    COLUMN course.date_end    COMMENT     C   COMMENT ON COLUMN public.course.date_end IS 'Дата конца';
          public          postgres    false    213            x           0    0    COLUMN course.status    COMMENT     E   COMMENT ON COLUMN public.course.status IS 'Статус курса';
          public          postgres    false    213            y           0    0    COLUMN course.teacher_id    COMMENT     L   COMMENT ON COLUMN public.course.teacher_id IS 'Преподаватель';
          public          postgres    false    213            z           0    0    COLUMN course.rate_med    COMMENT     Y   COMMENT ON COLUMN public.course.rate_med IS 'Средняя оценка за курс';
          public          postgres    false    213            ?            1259    25532    course_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.course_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.course_id_seq;
       public          postgres    false    213            {           0    0    course_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.course_id_seq OWNED BY public.course.id;
          public          postgres    false    212            ?            1259    25564    course_student    TABLE     ?   CREATE TABLE public.course_student (
    id integer NOT NULL,
    course_id integer NOT NULL,
    student_id integer NOT NULL
);
 "   DROP TABLE public.course_student;
       public         heap    postgres    false            |           0    0    COLUMN course_student.course_id    COMMENT     A   COMMENT ON COLUMN public.course_student.course_id IS 'Курс';
          public          postgres    false    215            }           0    0     COLUMN course_student.student_id    COMMENT     H   COMMENT ON COLUMN public.course_student.student_id IS 'Студент';
          public          postgres    false    215            ?            1259    25563    course_student_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.course_student_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.course_student_id_seq;
       public          postgres    false    215            ~           0    0    course_student_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.course_student_id_seq OWNED BY public.course_student.id;
          public          postgres    false    214            ?            1259    25603    lecture    TABLE     ?   CREATE TABLE public.lecture (
    id integer NOT NULL,
    num integer NOT NULL,
    name character varying(100) NOT NULL,
    course_id integer NOT NULL,
    rate double precision
);
    DROP TABLE public.lecture;
       public         heap    postgres    false                       0    0    COLUMN lecture.num    COMMENT     K   COMMENT ON COLUMN public.lecture.num IS 'Порядковый номер';
          public          postgres    false    219            ?           0    0    COLUMN lecture.name    COMMENT     B   COMMENT ON COLUMN public.lecture.name IS 'Тема лекции';
          public          postgres    false    219            ?           0    0    COLUMN lecture.course_id    COMMENT     :   COMMENT ON COLUMN public.lecture.course_id IS 'Курс';
          public          postgres    false    219            ?           0    0    COLUMN lecture.rate    COMMENT     9   COMMENT ON COLUMN public.lecture.rate IS 'Оценка';
          public          postgres    false    219            ?            1259    25602    lecture_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.lecture_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.lecture_id_seq;
       public          postgres    false    219            ?           0    0    lecture_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.lecture_id_seq OWNED BY public.lecture.id;
          public          postgres    false    218            ?            1259    25674    lesson    TABLE     ?   CREATE TABLE public.lesson (
    id integer NOT NULL,
    lecture_id integer NOT NULL,
    date date NOT NULL,
    time_start time(0) without time zone NOT NULL,
    time_end time(0) without time zone NOT NULL,
    place_id integer NOT NULL
);
    DROP TABLE public.lesson;
       public         heap    postgres    false            ?           0    0    COLUMN lesson.lecture_id    COMMENT     >   COMMENT ON COLUMN public.lesson.lecture_id IS 'Лекции';
          public          postgres    false    221            ?           0    0    COLUMN lesson.date    COMMENT     I   COMMENT ON COLUMN public.lesson.date IS 'Дата проведения';
          public          postgres    false    221            ?           0    0    COLUMN lesson.time_start    COMMENT     I   COMMENT ON COLUMN public.lesson.time_start IS 'Время начала';
          public          postgres    false    221            ?           0    0    COLUMN lesson.time_end    COMMENT     E   COMMENT ON COLUMN public.lesson.time_end IS 'Время конца';
          public          postgres    false    221            ?           0    0    COLUMN lesson.place_id    COMMENT     O   COMMENT ON COLUMN public.lesson.place_id IS 'Место проведения';
          public          postgres    false    221            ?            1259    25673    lesson_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.lesson_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.lesson_id_seq;
       public          postgres    false    221            ?           0    0    lesson_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.lesson_id_seq OWNED BY public.lesson.id;
          public          postgres    false    220            ?            1259    25517 	   migration    TABLE     g   CREATE TABLE public.migration (
    version character varying(180) NOT NULL,
    apply_time integer
);
    DROP TABLE public.migration;
       public         heap    postgres    false            ?            1259    25583    place    TABLE     ?   CREATE TABLE public.place (
    id integer NOT NULL,
    address character varying(200) NOT NULL,
    cabinet character varying(7) NOT NULL
);
    DROP TABLE public.place;
       public         heap    postgres    false            ?           0    0    COLUMN place.address    COMMENT     8   COMMENT ON COLUMN public.place.address IS 'Адрес';
          public          postgres    false    217            ?           0    0    COLUMN place.cabinet    COMMENT     <   COMMENT ON COLUMN public.place.cabinet IS 'Кабинет';
          public          postgres    false    217            ?            1259    25582    place_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.place_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.place_id_seq;
       public          postgres    false    217            ?           0    0    place_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.place_id_seq OWNED BY public.place.id;
          public          postgres    false    216            ?            1259    25523    user    TABLE     ?  CREATE TABLE public."user" (
    id integer NOT NULL,
    surname character varying(100) NOT NULL,
    firstname character varying(100) NOT NULL,
    patronymic character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    phone bigint,
    password_hash character varying(255) NOT NULL,
    comment character varying(1000),
    type smallint NOT NULL,
    is_admin boolean DEFAULT false NOT NULL
);
    DROP TABLE public."user";
       public         heap    postgres    false            ?           0    0    COLUMN "user".surname    COMMENT     =   COMMENT ON COLUMN public."user".surname IS 'Фамилия';
          public          postgres    false    211            ?           0    0    COLUMN "user".firstname    COMMENT     7   COMMENT ON COLUMN public."user".firstname IS 'Имя';
          public          postgres    false    211            ?           0    0    COLUMN "user".patronymic    COMMENT     B   COMMENT ON COLUMN public."user".patronymic IS 'Отчество';
          public          postgres    false    211            ?           0    0    COLUMN "user".email    COMMENT     7   COMMENT ON COLUMN public."user".email IS 'Почта';
          public          postgres    false    211            ?           0    0    COLUMN "user".phone    COMMENT     ;   COMMENT ON COLUMN public."user".phone IS 'Телефон';
          public          postgres    false    211            ?           0    0    COLUMN "user".password_hash    COMMENT     A   COMMENT ON COLUMN public."user".password_hash IS 'Пароль';
          public          postgres    false    211            ?           0    0    COLUMN "user".comment    COMMENT     [   COMMENT ON COLUMN public."user".comment IS 'Описание о пользователе';
          public          postgres    false    211            ?           0    0    COLUMN "user".type    COMMENT     D   COMMENT ON COLUMN public."user".type IS 'Пользователь';
          public          postgres    false    211            ?           0    0    COLUMN "user".is_admin    COMMENT     J   COMMENT ON COLUMN public."user".is_admin IS 'Администратор';
          public          postgres    false    211            ?            1259    25522    user_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.user_id_seq;
       public          postgres    false    211            ?           0    0    user_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;
          public          postgres    false    210            ?            1259    25693    visit    TABLE     ?   CREATE TABLE public.visit (
    id integer NOT NULL,
    student_id integer NOT NULL,
    lesson_id integer NOT NULL,
    rate integer
);
    DROP TABLE public.visit;
       public         heap    postgres    false            ?           0    0    COLUMN visit.student_id    COMMENT     ?   COMMENT ON COLUMN public.visit.student_id IS 'Студент';
          public          postgres    false    223            ?           0    0    COLUMN visit.lesson_id    COMMENT     >   COMMENT ON COLUMN public.visit.lesson_id IS 'Занятие';
          public          postgres    false    223            ?           0    0    COLUMN visit.rate    COMMENT     7   COMMENT ON COLUMN public.visit.rate IS 'Оценка';
          public          postgres    false    223            ?            1259    25692    visit_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.visit_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.visit_id_seq;
       public          postgres    false    223            ?           0    0    visit_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.visit_id_seq OWNED BY public.visit.id;
          public          postgres    false    222            ?           2604    25536 	   course id    DEFAULT     f   ALTER TABLE ONLY public.course ALTER COLUMN id SET DEFAULT nextval('public.course_id_seq'::regclass);
 8   ALTER TABLE public.course ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    213    212    213            ?           2604    25567    course_student id    DEFAULT     v   ALTER TABLE ONLY public.course_student ALTER COLUMN id SET DEFAULT nextval('public.course_student_id_seq'::regclass);
 @   ALTER TABLE public.course_student ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    214    215            ?           2604    25606 
   lecture id    DEFAULT     h   ALTER TABLE ONLY public.lecture ALTER COLUMN id SET DEFAULT nextval('public.lecture_id_seq'::regclass);
 9   ALTER TABLE public.lecture ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    218    219    219            ?           2604    25677 	   lesson id    DEFAULT     f   ALTER TABLE ONLY public.lesson ALTER COLUMN id SET DEFAULT nextval('public.lesson_id_seq'::regclass);
 8   ALTER TABLE public.lesson ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    221    221            ?           2604    25586    place id    DEFAULT     d   ALTER TABLE ONLY public.place ALTER COLUMN id SET DEFAULT nextval('public.place_id_seq'::regclass);
 7   ALTER TABLE public.place ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    217    217            ?           2604    25526    user id    DEFAULT     d   ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);
 8   ALTER TABLE public."user" ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    211    210    211            ?           2604    25696    visit id    DEFAULT     d   ALTER TABLE ONLY public.visit ALTER COLUMN id SET DEFAULT nextval('public.visit_id_seq'::regclass);
 7   ALTER TABLE public.visit ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    222    223            d          0    25533    course 
   TABLE DATA           ^   COPY public.course (id, name, date_start, date_end, status, teacher_id, rate_med) FROM stdin;
    public          postgres    false    213   7j       f          0    25564    course_student 
   TABLE DATA           C   COPY public.course_student (id, course_id, student_id) FROM stdin;
    public          postgres    false    215   ?j       j          0    25603    lecture 
   TABLE DATA           A   COPY public.lecture (id, num, name, course_id, rate) FROM stdin;
    public          postgres    false    219   ?j       l          0    25674    lesson 
   TABLE DATA           V   COPY public.lesson (id, lecture_id, date, time_start, time_end, place_id) FROM stdin;
    public          postgres    false    221   pk       `          0    25517 	   migration 
   TABLE DATA           8   COPY public.migration (version, apply_time) FROM stdin;
    public          postgres    false    209   ?k       h          0    25583    place 
   TABLE DATA           5   COPY public.place (id, address, cabinet) FROM stdin;
    public          postgres    false    217   ?l       b          0    25523    user 
   TABLE DATA           z   COPY public."user" (id, surname, firstname, patronymic, email, phone, password_hash, comment, type, is_admin) FROM stdin;
    public          postgres    false    211   Gm       n          0    25693    visit 
   TABLE DATA           @   COPY public.visit (id, student_id, lesson_id, rate) FROM stdin;
    public          postgres    false    223   ?o       ?           0    0    course_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.course_id_seq', 6, true);
          public          postgres    false    212            ?           0    0    course_student_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.course_student_id_seq', 29, true);
          public          postgres    false    214            ?           0    0    lecture_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.lecture_id_seq', 19, true);
          public          postgres    false    218            ?           0    0    lesson_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.lesson_id_seq', 13, true);
          public          postgres    false    220            ?           0    0    place_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.place_id_seq', 3, true);
          public          postgres    false    216            ?           0    0    user_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.user_id_seq', 27, true);
          public          postgres    false    210            ?           0    0    visit_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.visit_id_seq', 18, true);
          public          postgres    false    222            ?           2606    25538    course course_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.course
    ADD CONSTRAINT course_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.course DROP CONSTRAINT course_pkey;
       public            postgres    false    213            ?           2606    25569 "   course_student course_student_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.course_student
    ADD CONSTRAINT course_student_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.course_student DROP CONSTRAINT course_student_pkey;
       public            postgres    false    215            ?           2606    25608    lecture lecture_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.lecture
    ADD CONSTRAINT lecture_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.lecture DROP CONSTRAINT lecture_pkey;
       public            postgres    false    219            ?           2606    25679    lesson lesson_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.lesson
    ADD CONSTRAINT lesson_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.lesson DROP CONSTRAINT lesson_pkey;
       public            postgres    false    221            ?           2606    25521    migration migration_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);
 B   ALTER TABLE ONLY public.migration DROP CONSTRAINT migration_pkey;
       public            postgres    false    209            ?           2606    25588    place place_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.place
    ADD CONSTRAINT place_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.place DROP CONSTRAINT place_pkey;
       public            postgres    false    217            ?           2606    25531    user user_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public            postgres    false    211            ?           2606    25698    visit visit_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.visit
    ADD CONSTRAINT visit_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.visit DROP CONSTRAINT visit_pkey;
       public            postgres    false    223            ?           1259    25575    idx_course_student_student_id    INDEX     ^   CREATE INDEX idx_course_student_student_id ON public.course_student USING btree (student_id);
 1   DROP INDEX public.idx_course_student_student_id;
       public            postgres    false    215            ?           1259    25581    idx_course_student_to_course_id    INDEX     _   CREATE INDEX idx_course_student_to_course_id ON public.course_student USING btree (course_id);
 3   DROP INDEX public.idx_course_student_to_course_id;
       public            postgres    false    215            ?           1259    25544    idx_course_teacher_id    INDEX     N   CREATE INDEX idx_course_teacher_id ON public.course USING btree (teacher_id);
 )   DROP INDEX public.idx_course_teacher_id;
       public            postgres    false    213            ?           1259    25614    idx_lecture_to_course_id    INDEX     Q   CREATE INDEX idx_lecture_to_course_id ON public.lecture USING btree (course_id);
 ,   DROP INDEX public.idx_lecture_to_course_id;
       public            postgres    false    219            ?           1259    25691    idx_lesson_to_lecture_id    INDEX     Q   CREATE INDEX idx_lesson_to_lecture_id ON public.lesson USING btree (lecture_id);
 ,   DROP INDEX public.idx_lesson_to_lecture_id;
       public            postgres    false    221            ?           1259    25685    idx_lesson_to_place_id    INDEX     M   CREATE INDEX idx_lesson_to_place_id ON public.lesson USING btree (place_id);
 *   DROP INDEX public.idx_lesson_to_place_id;
       public            postgres    false    221            ?           1259    25710    idx_visit_to_lesson_id    INDEX     M   CREATE INDEX idx_visit_to_lesson_id ON public.visit USING btree (lesson_id);
 *   DROP INDEX public.idx_visit_to_lesson_id;
       public            postgres    false    223            ?           1259    25704    idx_visit_to_user_id    INDEX     L   CREATE INDEX idx_visit_to_user_id ON public.visit USING btree (student_id);
 (   DROP INDEX public.idx_visit_to_user_id;
       public            postgres    false    223            ?           2606    25576 *   course_student fk_course_student_to_course    FK CONSTRAINT     ?   ALTER TABLE ONLY public.course_student
    ADD CONSTRAINT fk_course_student_to_course FOREIGN KEY (course_id) REFERENCES public.course(id);
 T   ALTER TABLE ONLY public.course_student DROP CONSTRAINT fk_course_student_to_course;
       public          postgres    false    213    3258    215            ?           2606    25570 (   course_student fk_course_student_to_user    FK CONSTRAINT     ?   ALTER TABLE ONLY public.course_student
    ADD CONSTRAINT fk_course_student_to_user FOREIGN KEY (student_id) REFERENCES public."user"(id);
 R   ALTER TABLE ONLY public.course_student DROP CONSTRAINT fk_course_student_to_user;
       public          postgres    false    3256    215    211            ?           2606    25609    lecture fk_lecture_to_course    FK CONSTRAINT     ~   ALTER TABLE ONLY public.lecture
    ADD CONSTRAINT fk_lecture_to_course FOREIGN KEY (course_id) REFERENCES public.course(id);
 F   ALTER TABLE ONLY public.lecture DROP CONSTRAINT fk_lecture_to_course;
       public          postgres    false    219    213    3258            ?           2606    25686    lesson fk_lesson_to_lecture    FK CONSTRAINT        ALTER TABLE ONLY public.lesson
    ADD CONSTRAINT fk_lesson_to_lecture FOREIGN KEY (lecture_id) REFERENCES public.lecture(id);
 E   ALTER TABLE ONLY public.lesson DROP CONSTRAINT fk_lesson_to_lecture;
       public          postgres    false    3268    221    219            ?           2606    25680    lesson fk_lesson_to_place    FK CONSTRAINT     y   ALTER TABLE ONLY public.lesson
    ADD CONSTRAINT fk_lesson_to_place FOREIGN KEY (place_id) REFERENCES public.place(id);
 C   ALTER TABLE ONLY public.lesson DROP CONSTRAINT fk_lesson_to_place;
       public          postgres    false    221    217    3265            ?           2606    25539    course fk_person_id_to_course    FK CONSTRAINT     ?   ALTER TABLE ONLY public.course
    ADD CONSTRAINT fk_person_id_to_course FOREIGN KEY (teacher_id) REFERENCES public."user"(id) ON UPDATE CASCADE ON DELETE CASCADE;
 G   ALTER TABLE ONLY public.course DROP CONSTRAINT fk_person_id_to_course;
       public          postgres    false    211    3256    213            ?           2606    25705    visit fk_visit_to_lesson    FK CONSTRAINT     z   ALTER TABLE ONLY public.visit
    ADD CONSTRAINT fk_visit_to_lesson FOREIGN KEY (lesson_id) REFERENCES public.lesson(id);
 B   ALTER TABLE ONLY public.visit DROP CONSTRAINT fk_visit_to_lesson;
       public          postgres    false    221    3272    223            ?           2606    25699    visit fk_visit_to_user    FK CONSTRAINT     y   ALTER TABLE ONLY public.visit
    ADD CONSTRAINT fk_visit_to_user FOREIGN KEY (student_id) REFERENCES public."user"(id);
 @   ALTER TABLE ONLY public.visit DROP CONSTRAINT fk_visit_to_user;
       public          postgres    false    211    3256    223            d   @   x?3???4202?50?54?2?u?,89??8c???8?}?F@eP????	H?9HM? "??      f   (   x?32?4?42?22?f\F?f?F&\F? ڔ+F??? e?/      j   ?   x?]???0E??? ?@?(E??B?(? ?I?UP?RpX??F\????????fN??]??p?gt|?W???ppZ?j.)?|?LD???/?Q?sٓ?Po	<??6?Y`?$M??1\Ȧ?ؿM?B??=5>pR8Q:Q??Y??G???Z??A3??D)?B?c:      l   X   x?????0?3?R??Y?1iӨ1^??	N*jEP???4BGn????0????4q3??????#(a?K?Q??t,?|?v&<      `   ?   x?}?ˎ?0?5??G\;???NH??&??	L;#?7ޜ{-????:?9??S2???DH`?@?ԗ眦X????@l???W;\?)?V3??_??c?ӹ???R?Tg??K
#vX???m?????B??IV<????;WR?q??????¹ro?m<????AT?o: l??S>?7?????^ ?U#?*?F}?~aaw?;?A??]      h   ?   x?u?1?P???=Ŗ???dw?6F??1????J?0{#?P????|????=?????`/??[???0b??t$?
?+?r8?????>?T?t?i0?_tH??葃n?"?D?/<?2-7VA??m S?S$??jL      b   <  x????n?@?????? ??Bb_?;????\q?q???R?.???ʢjU?????Di_ax?i?E馛???????? ?^?]v?????W|?????{|?
?c~??o?}!D?~`?b??`?G?{1K?+f?
????)??KB?~?;??띳)?%C?\?S?? f5????qw?O???]???,ٷ?k??l??,??Q?????ď???^??m?=*?&̶GI?w ,?\???????J?u5???e????,????????n<??Q??1s?M????c?%MK???DBk??gHo2Gn?/>???in??Z??M??E?[??е?Т6K?9O"HSG겙?m??q??d?kez?????=?5H?>?q?T????????1????!Ce6?l<Y?ۄ?I??x??G#k$n?sJE?@?C?q?A???f??JU?|ڳL????|Ŷ?????B?(%?'?E?d?7M?|?????????C?sAx???W?)ǟ??s?Kg?(;hG?aId/???Tǧ?ZOuu%??0???LJ???>?9!j??/;???      n      x?????? ? ?     