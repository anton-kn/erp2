PGDMP     +                    z            erp2 #   14.5 (Ubuntu 14.5-0ubuntu0.22.04.1) #   14.5 (Ubuntu 14.5-0ubuntu0.22.04.1) 3    ?           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            @           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            A           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            B           1262    25516    erp2    DATABASE     Y   CREATE DATABASE erp2 WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'ru_RU.UTF-8';
    DROP DATABASE erp2;
                postgres    false            �            1259    25533    course    TABLE     �   CREATE TABLE public.course (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    date_start date,
    date_end date,
    status integer NOT NULL,
    teacher_id integer NOT NULL,
    rate_med double precision
);
    DROP TABLE public.course;
       public         heap    postgres    false            C           0    0    COLUMN course.name    COMMENT     <   COMMENT ON COLUMN public.course.name IS 'Название';
          public          postgres    false    213            D           0    0    COLUMN course.date_start    COMMENT     G   COMMENT ON COLUMN public.course.date_start IS 'Дата начала';
          public          postgres    false    213            E           0    0    COLUMN course.date_end    COMMENT     C   COMMENT ON COLUMN public.course.date_end IS 'Дата конца';
          public          postgres    false    213            F           0    0    COLUMN course.status    COMMENT     E   COMMENT ON COLUMN public.course.status IS 'Статус курса';
          public          postgres    false    213            G           0    0    COLUMN course.teacher_id    COMMENT     L   COMMENT ON COLUMN public.course.teacher_id IS 'Преподаватель';
          public          postgres    false    213            H           0    0    COLUMN course.rate_med    COMMENT     Y   COMMENT ON COLUMN public.course.rate_med IS 'Средняя оценка за курс';
          public          postgres    false    213            �            1259    25532    course_id_seq    SEQUENCE     �   CREATE SEQUENCE public.course_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.course_id_seq;
       public          postgres    false    213            I           0    0    course_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.course_id_seq OWNED BY public.course.id;
          public          postgres    false    212            �            1259    25564    course_student    TABLE     �   CREATE TABLE public.course_student (
    id integer NOT NULL,
    course_id integer NOT NULL,
    student_id integer NOT NULL
);
 "   DROP TABLE public.course_student;
       public         heap    postgres    false            J           0    0    COLUMN course_student.course_id    COMMENT     A   COMMENT ON COLUMN public.course_student.course_id IS 'Курс';
          public          postgres    false    215            K           0    0     COLUMN course_student.student_id    COMMENT     H   COMMENT ON COLUMN public.course_student.student_id IS 'Студент';
          public          postgres    false    215            �            1259    25563    course_student_id_seq    SEQUENCE     �   CREATE SEQUENCE public.course_student_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.course_student_id_seq;
       public          postgres    false    215            L           0    0    course_student_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.course_student_id_seq OWNED BY public.course_student.id;
          public          postgres    false    214            �            1259    25517 	   migration    TABLE     g   CREATE TABLE public.migration (
    version character varying(180) NOT NULL,
    apply_time integer
);
    DROP TABLE public.migration;
       public         heap    postgres    false            �            1259    25523    user    TABLE     �  CREATE TABLE public."user" (
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
       public         heap    postgres    false            M           0    0    COLUMN "user".surname    COMMENT     =   COMMENT ON COLUMN public."user".surname IS 'Фамилия';
          public          postgres    false    211            N           0    0    COLUMN "user".firstname    COMMENT     7   COMMENT ON COLUMN public."user".firstname IS 'Имя';
          public          postgres    false    211            O           0    0    COLUMN "user".patronymic    COMMENT     B   COMMENT ON COLUMN public."user".patronymic IS 'Отчество';
          public          postgres    false    211            P           0    0    COLUMN "user".email    COMMENT     7   COMMENT ON COLUMN public."user".email IS 'Почта';
          public          postgres    false    211            Q           0    0    COLUMN "user".phone    COMMENT     ;   COMMENT ON COLUMN public."user".phone IS 'Телефон';
          public          postgres    false    211            R           0    0    COLUMN "user".password_hash    COMMENT     A   COMMENT ON COLUMN public."user".password_hash IS 'Пароль';
          public          postgres    false    211            S           0    0    COLUMN "user".comment    COMMENT     [   COMMENT ON COLUMN public."user".comment IS 'Описание о пользователе';
          public          postgres    false    211            T           0    0    COLUMN "user".type    COMMENT     D   COMMENT ON COLUMN public."user".type IS 'Пользователь';
          public          postgres    false    211            U           0    0    COLUMN "user".is_admin    COMMENT     J   COMMENT ON COLUMN public."user".is_admin IS 'Администратор';
          public          postgres    false    211            �            1259    25522    user_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.user_id_seq;
       public          postgres    false    211            V           0    0    user_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;
          public          postgres    false    210            �           2604    25536 	   course id    DEFAULT     f   ALTER TABLE ONLY public.course ALTER COLUMN id SET DEFAULT nextval('public.course_id_seq'::regclass);
 8   ALTER TABLE public.course ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    212    213    213            �           2604    25567    course_student id    DEFAULT     v   ALTER TABLE ONLY public.course_student ALTER COLUMN id SET DEFAULT nextval('public.course_student_id_seq'::regclass);
 @   ALTER TABLE public.course_student ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    214    215            �           2604    25526    user id    DEFAULT     d   ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);
 8   ALTER TABLE public."user" ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    211    210    211            :          0    25533    course 
   TABLE DATA           ^   COPY public.course (id, name, date_start, date_end, status, teacher_id, rate_med) FROM stdin;
    public          postgres    false    213   �4       <          0    25564    course_student 
   TABLE DATA           C   COPY public.course_student (id, course_id, student_id) FROM stdin;
    public          postgres    false    215   >5       6          0    25517 	   migration 
   TABLE DATA           8   COPY public.migration (version, apply_time) FROM stdin;
    public          postgres    false    209   m5       8          0    25523    user 
   TABLE DATA           z   COPY public."user" (id, surname, firstname, patronymic, email, phone, password_hash, comment, type, is_admin) FROM stdin;
    public          postgres    false    211   �5       W           0    0    course_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.course_id_seq', 2, true);
          public          postgres    false    212            X           0    0    course_student_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.course_student_id_seq', 13, true);
          public          postgres    false    214            Y           0    0    user_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.user_id_seq', 16, true);
          public          postgres    false    210            �           2606    25538    course course_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.course
    ADD CONSTRAINT course_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.course DROP CONSTRAINT course_pkey;
       public            postgres    false    213            �           2606    25569 "   course_student course_student_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.course_student
    ADD CONSTRAINT course_student_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.course_student DROP CONSTRAINT course_student_pkey;
       public            postgres    false    215            �           2606    25521    migration migration_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);
 B   ALTER TABLE ONLY public.migration DROP CONSTRAINT migration_pkey;
       public            postgres    false    209            �           2606    25531    user user_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public            postgres    false    211            �           1259    25575    idx_course_student_student_id    INDEX     ^   CREATE INDEX idx_course_student_student_id ON public.course_student USING btree (student_id);
 1   DROP INDEX public.idx_course_student_student_id;
       public            postgres    false    215            �           1259    25581    idx_course_student_to_course_id    INDEX     _   CREATE INDEX idx_course_student_to_course_id ON public.course_student USING btree (course_id);
 3   DROP INDEX public.idx_course_student_to_course_id;
       public            postgres    false    215            �           1259    25544    idx_course_teacher_id    INDEX     N   CREATE INDEX idx_course_teacher_id ON public.course USING btree (teacher_id);
 )   DROP INDEX public.idx_course_teacher_id;
       public            postgres    false    213            �           2606    25576 *   course_student fk_course_student_to_course    FK CONSTRAINT     �   ALTER TABLE ONLY public.course_student
    ADD CONSTRAINT fk_course_student_to_course FOREIGN KEY (course_id) REFERENCES public.course(id);
 T   ALTER TABLE ONLY public.course_student DROP CONSTRAINT fk_course_student_to_course;
       public          postgres    false    213    215    3234            �           2606    25570 (   course_student fk_course_student_to_user    FK CONSTRAINT     �   ALTER TABLE ONLY public.course_student
    ADD CONSTRAINT fk_course_student_to_user FOREIGN KEY (student_id) REFERENCES public."user"(id);
 R   ALTER TABLE ONLY public.course_student DROP CONSTRAINT fk_course_student_to_user;
       public          postgres    false    215    3232    211            �           2606    25539    course fk_person_id_to_course    FK CONSTRAINT     �   ALTER TABLE ONLY public.course
    ADD CONSTRAINT fk_person_id_to_course FOREIGN KEY (teacher_id) REFERENCES public."user"(id) ON UPDATE CASCADE ON DELETE CASCADE;
 G   ALTER TABLE ONLY public.course DROP CONSTRAINT fk_person_id_to_course;
       public          postgres    false    3232    213    211            :   P   x�3��P�0�bㅽ�]�t������H��X���4�50�B3�?.#��@��04��TA�� �1��!HC� :.P      <      x�34�B.C# m�eh�s��qqq 8�      6   o   x�]�I�@D�u|��vc�K$��H=�? Dm��Ղ�ٖ!�Q�@aU��0�Š�6fOխ�V�0�6r��2~����r�$��5�QG��E��&_���+�<� ���2�      8   �  x�m��n�P���)��3�`v���x�e�L66_<��HQ��Ԩ�.*UU_ J�J���ߨ�o�������D3<g��|�i� rVGN��	N��zO��F��~�0�H5�>�VQLS�_\K���P��i[g�.O%���4�c����w���G�o
o�p�����ٚ�]S���lH�������D"A�j8to!�ٔuI4��2����q��n�Æ`s���m��k��	2>�D�c���USD0qU�M����X�T5��Ү��@��.�(0����Z��]���W�/���?q�o�a�c�`m�j�Z�7k�]c�L�����J��|YH�
5������r�"�0��
��O�w�7��(�c�~d��cr;�J��u��U{��v�e�>@Q#�ф���ӶE�˨Mc`<G�y�)��N.���5��A�@��[
�$�g�쎀42,f��Ith� ��Ǖ���ei���p^�*�A:�/i>!P�Nm!���b��w����W��8&��2��5�l��e襮u<�j�j�ԋ�^�(����9o���xsfL�C{��ξ	��X�2�|�$�>&{��!��-�U��0,��Rr,
�lї��5�M����ň%��|���lYsmK@%�c��ݻ�[_$)��-��1�_��#ڕ�i�B���K�K�(�p"]�,���PI�A�9c�'6�4[l���J��X��     