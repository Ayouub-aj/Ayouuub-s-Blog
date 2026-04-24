# 📝 BlogPersonal — Laravel Blog Application Task Board
**SCRUM Board:** 20/04/2026 → 24/04/2026 | **Mode:** Individuel | **SprintDeadline:** Vendredi 24/04 – 13:00

---

## 📋 Legend

| Label | Meaning |
|-------|---------|
| `ARCH` | Architecture / Setup |
| `DOCKER` | Docker / Infrastructure |
| `MOD1` | Module 1 — Public Blog |
| `MOD2` | Module 2 — Authentication |
| `MOD3` | Module 3 — Article Management |
| `QA` | Code Quality / Security |
| `DOC` | Documentation / Livrables |
| `BONUS` | Bonus Feature |

---

## 🏃 Sprint 1 — Infrastructure & Setup
**Objectif:** Environnement Docker opérationnel, projet Laravel initialisé, base de données prête
**Durée:** Jour 1 — Lundi 20/04

| Done | # | Task | Label | Priority | Time | Detailed Implementation & Files |
| :---: | :--- | :--- | :---: | :---: | :---: | :--- |
| ✅ | T-01 | Initialiser le repo GitHub + `.gitignore` | `ARCH` | High | 0.3h | **Files to Create:**<br>- `.gitignore`: Ignorer `vendor/`, `.env`, `node_modules/`, `.docker/`<br>- `README.md`: Skeleton initial<br>- Créer branches: `feature/auth`, `feature/public-blog`, `feature/article-crud` |
| ✅ | T-02 | Créer `docker-compose.yml` | `DOCKER` | High | 1h | **Files to Create:**<br>- `docker-compose.yml`: Services `app` (PHP 8.2-fpm), `webserver` (Nginx), `db` (MySQL 8.0), `phpmyadmin`<br>- Volumes: `./src:/var/www`, `dbdata:/var/lib/mysql`<br>- Network: `app-network` |
| ✅ | T-03 | Créer `Dockerfile` (PHP + Laravel deps) | `DOCKER` | High | 1h | **Files to Create:**<br>- `Dockerfile`: Base `php:8.2-fpm`, extensions `pdo_mysql`, `mbstring`, `zip`, `exif`, `pcntl`<br>- Installer `composer` dans l'image<br>- `docker/nginx/conf.d/app.conf`: Config Nginx pointant sur `/var/www/public` |
| ✅ | T-04 | Lancer et vérifier l'environnement Docker | `DOCKER` | High | 0.5h | **Action:**<br>- `docker-compose up -d --build`<br>- Vérifier `docker-compose ps` — tous les services `Up`<br>- Accès `http://localhost` → page Laravel par défaut |
| ✅ | T-05 | Créer le projet Laravel dans le container | `ARCH` | High | 0.5h | **Action:**<br>- `docker-compose exec app composer create-project laravel/laravel .`<br>- Vérifier `http://localhost` → Laravel welcome page |
| ✅ | T-06 | Configurer `.env` (DB via Docker) | `ARCH` | High | 0.3h | **Files to Edit:**<br>- `.env`: `DB_HOST=db`, `DB_DATABASE=blog`, `DB_USERNAME=root`, `DB_PASSWORD=secret`<br>- `APP_NAME=BlogPersonal`, `APP_URL=http://localhost` |
| [ ] | T-07 | Migration — Table `categories` | `ARCH` | High | 0.5h | **Files to Create:**<br>- `database/migrations/..._create_categories_table.php`: Colonnes `id`, `name`, `timestamps`<br>- `docker-compose exec app php artisan make:migration create_categories_table` |
| [ ] | T-08 | Migration — Table `articles` | `ARCH` | High | 1h | **Files to Create:**<br>- `database/migrations/..._create_articles_table.php`: Colonnes `id`, `title`, `content`, `status` (draft/published), `category_id` (FK), `user_id` (FK), `timestamps`<br>- `docker-compose exec app php artisan make:migration create_articles_table` |
| [ ] | T-09 | Model `Category` + Model `Article` | `ARCH` | High | 1h | **Files to Create:**<br>- `app/Models/Category.php`: `$fillable = ['name']`, relation `hasMany(Article::class)`<br>- `app/Models/Article.php`: `$fillable = ['title','content','status','category_id','user_id']`, `belongsTo(Category::class)`, `belongsTo(User::class)` |
| [ ] | T-10 | Seeders complets | `ARCH` | High | 1.5h | **Files to Create:**<br>- `database/seeders/CategorySeeder.php`: 4 catégories (Laravel, PHP, DevOps, Tips)<br>- `database/seeders/UserSeeder.php`: 1 blogger (email + `Hash::make('password')`)<br>- `database/seeders/ArticleSeeder.php`: 6 articles mix draft/published<br>- `database/seeders/DatabaseSeeder.php`: Appeler les 3 seeders<br>- `docker-compose exec app php artisan migrate:fresh --seed` doit passer ✅ |

**Sprint 1 — Definition of Done:**
- [ ] `docker-compose up -d` démarre tous les services sans erreur
- [ ] `http://localhost` affiche la page Laravel
- [ ] `docker-compose exec app php artisan migrate:fresh --seed` fonctionne
- [ ] Base de données visible dans phpMyAdmin (`http://localhost:8080`)

---

## 🏃 Sprint 2 — Public Blog (US1, US2, US3)
**Objectif:** Un visiteur peut lister, lire et filtrer les articles sans compte
**Durée:** Jour 2 — Mardi 21/04

| Done | # | Task | Label | Priority | Time | Detailed Implementation & Files |
| :---: | :--- | :--- | :---: | :---: | :---: | :--- |
| [ ] | T-11 | Layout principal Blade | `MOD1` | High | 1.5h | **Files to Create:**<br>- `resources/views/layouts/app.blade.php`: HTML structure, `@yield('content')`, navbar avec `@auth`/`@guest`<br>- Liens conditionnels: visiteur → Login / blogger → Dashboard + Logout |
| [ ] | T-12 | `US1` — Liste des articles publiés | `MOD1` | High | 2h | **Files to Create:**<br>- `docker-compose exec app php artisan make:controller ArticleController --resource`<br>- `ArticleController@index`: Query `status = published` avec `with('category')`<br>- `resources/views/articles/index.blade.php`: Titre, catégorie, date, excerpt<br>**Route:** `GET /` → `articles.index` |
| [ ] | T-13 | `US2` — Détail d'un article | `MOD1` | High | 1.5h | **Files to Create/Edit:**<br>- `ArticleController@show`: `Article::with('category')->findOrFail($id)`<br>- `resources/views/articles/show.blade.php`: Contenu complet + catégorie<br>**Route:** `GET /articles/{article}` → `articles.show` |
| [ ] | T-14 | `US3` — Filtre par catégorie | `MOD1` | High | 2h | **Files to Create:**<br>- `docker-compose exec app php artisan make:controller CategoryController`<br>- `CategoryController@show`: Articles filtrés par catégorie (`status = published`)<br>- `articles/index.blade.php`: Liens de filtre par catégorie<br>**Route:** `GET /categories/{category}` → `categories.show` |

**Sprint 2 — Definition of Done:**
- [ ] La liste des articles publiés s'affiche sur `/`
- [ ] Cliquer sur un article affiche son contenu complet
- [ ] Filtrer par catégorie ne retourne que les articles de cette catégorie
- [ ] Les articles en `draft` n'apparaissent pas sur la page publique

---

## 🏃 Sprint 3 — Authentication (US4)
**Objectif:** Le blogger peut se connecter et se déconnecter
**Durée:** Jour 3 matin — Mercredi 22/04

| Done | # | Task | Label | Priority | Time | Detailed Implementation & Files |
| :---: | :--- | :--- | :---: | :---: | :---: | :--- |
| [ ] | T-15 | Page de connexion (formulaire) | `MOD2` | High | 1h | **Files to Create:**<br>- `docker-compose exec app php artisan make:controller Auth/LoginController`<br>- `LoginController@showLoginForm`: Retourne la vue<br>- `resources/views/auth/login.blade.php`: Formulaire email/password, `@csrf`, messages `@error`<br>**Route:** `GET /login` → `login` |
| [ ] | T-16 | Logique login / logout | `MOD2` | High | 1h | **Files to Edit:**<br>- `LoginController@login`: `$request->validate([...])`, `Auth::attempt()`, redirect dashboard<br>- `LoginController@logout`: `Auth::logout()` + `redirect('/')`<br>**Routes:** `POST /login`, `POST /logout` → `logout` |
| [ ] | T-17 | Protection des routes avec `auth` middleware | `MOD2` | High | 1h | **Files to Edit:**<br>- `routes/web.php`: Grouper `/dashboard`, `/articles/create`, `/articles/{id}/edit`, `DELETE /articles/{id}` sous `Route::middleware('auth')->group(...)`<br>- Tester accès direct à `/articles/create` sans connexion → redirect `/login` |

**Sprint 3 — Definition of Done:**
- [ ] Login avec les identifiants du seeder fonctionne
- [ ] Logout redirige vers `/`
- [ ] Accès à `/articles/create` sans connexion → redirect `/login`
- [ ] `@auth`/`@guest` dans le layout affiche les bons liens

---

## 🏃 Sprint 4 — Article Management (US5, US6, US7, US8)
**Objectif:** CRUD complet des articles pour le blogger connecté
**Durée:** Jour 3 après-midi + Jour 4 — Mercredi 22/04 → Jeudi 23/04

| Done | # | Task | Label | Priority | Time | Detailed Implementation & Files |
| :---: | :--- | :--- | :---: | :---: | :---: | :--- |
| [ ] | T-18 | `US5` — Dashboard blogger | `MOD3` | High | 2h | **Files to Create:**<br>- `docker-compose exec app php artisan make:controller DashboardController`<br>- `DashboardController@index`: Tous les articles de `Auth::user()` (draft + published)<br>- `resources/views/dashboard/index.blade.php`: Tableau titre, statut, date, boutons Edit / Delete<br>**Route:** `GET /dashboard` → `dashboard.index` (middleware auth) |
| [ ] | T-19 | `US6` — Créer un article | `MOD3` | High | 2.5h | **Files to Create/Edit:**<br>- `ArticleController@create`: Passer les catégories à la vue<br>- `ArticleController@store`: `$request->validate([...])`, `Article::create([..., 'user_id' => Auth::id()])`<br>- `resources/views/articles/create.blade.php`: Champs titre, content, select catégorie, select statut, `@csrf`<br>**Routes:** `GET /articles/create` → `articles.create`, `POST /articles` → `articles.store` |
| [ ] | T-20 | `US7` — Modifier un article | `MOD3` | High | 2h | **Files to Create/Edit:**<br>- `ArticleController@edit`: `findOrFail($id)`, passer catégories<br>- `ArticleController@update`: Validation + `$article->update([...])`<br>- `resources/views/articles/edit.blade.php`: Formulaire pré-rempli, `@method('PUT')`, `@csrf`<br>**Routes:** `GET /articles/{article}/edit` → `articles.edit`, `PUT /articles/{article}` → `articles.update` |
| [ ] | T-21 | `US8` — Supprimer un article | `MOD3` | High | 1.5h | **Files to Edit:**<br>- `ArticleController@destroy`: `$article->delete()`, redirect dashboard avec message flash<br>- `dashboard/index.blade.php`: Formulaire avec `@method('DELETE')`, `@csrf`, `onclick="return confirm('...')"`<br>**Route:** `DELETE /articles/{article}` → `articles.destroy` |
| [ ] | T-22 | Vérification routes nommées complètes | `ARCH` | High | 0.5h | **Action:**<br>- `docker-compose exec app php artisan route:list`<br>- Toutes les routes ont un `name()`<br>- Routes protégées visibles avec middleware `auth` |

**Sprint 4 — Definition of Done:**
- [ ] Dashboard affiche tous les articles (draft + published)
- [ ] Création d'un article avec statut draft fonctionne
- [ ] Modification du statut draft → published fonctionne
- [ ] Suppression avec confirmation fonctionne
- [ ] `docker-compose exec app php artisan route:list` affiche toutes les routes nommées

---

## 🏃 Sprint 5 — QA, Bonus & Livrables
**Objectif:** Sécurité, qualité du code, bonus, README et préparation soutenance
**Durée:** Jour 5 — Vendredi 24/04

| Done | # | Task | Label | Priority | Time | Detailed Implementation & Files |
| :---: | :--- | :--- | :---: | :---: | :---: | :--- |
| [ ] | T-23 | Validation `$request->validate()` sur tous les forms | `QA` | High | 1h | **Files to Audit:**<br>- `ArticleController@store` et `@update`: `title\|required\|max:255`, `content\|required`, `category_id\|required\|exists:categories,id`, `status\|required\|in:draft,published`<br>- `LoginController@login`: `email\|required\|email`, `password\|required` |
| [ ] | T-24 | Audit `@csrf` et `@method` sur tous les formulaires | `QA` | High | 0.5h | **Action:**<br>- Vérifier `@csrf` dans: login, create, edit, delete<br>- Vérifier `@method('PUT')` dans edit, `@method('DELETE')` dans delete |
| [ ] | T-25 | Test parcours visiteur complet | `QA` | High | 0.5h | **Scénario:**<br>- Liste → filtre catégorie → lire article complet<br>- Vérifier que les drafts n'apparaissent pas publiquement<br>- Accès `/articles/create` sans login → redirect `/login` |
| [ ] | T-26 | Test parcours blogger complet | `QA` | High | 0.5h | **Scénario:**<br>- Login → dashboard → créer draft → publier → modifier → supprimer → logout<br>- `docker-compose exec app php artisan migrate:fresh --seed` → tout repart de zéro ✅ |
| [ ] | T-27 | Bonus — Implémenter 1 fonctionnalité | `BONUS` | Low | 2h | **Options (choisir UNE):**<br>- **Pagination:** `->paginate(6)` dans `ArticleController@index` + `{{ $articles->links() }}` dans la vue<br>- **Search:** Champ recherche sur titre + `->where('title', 'LIKE', "%{$q}%")` dans le controller<br>- **Reading Time:** `ceil(str_word_count($article->content) / 200)` min affiché dans la vue show |
| [ ] | T-28 | `README.md` complet | `DOC` | Medium | 1h | **Sections:**<br>- Description du projet<br>- Prérequis: Docker, Docker Compose<br>- Instructions: `git clone` → `cp .env.example .env` → `docker-compose up -d --build` → `docker-compose exec app php artisan migrate:fresh --seed`<br>- Identifiants blogger (email + password)<br>- Table des routes disponibles |
| [ ] | T-29 | Audit commits & branches Git | `DOC` | High | 0.3h | **Action:**<br>- Vérifier ≥ 15 commits avec messages explicites<br>- Branches `feature/auth`, `feature/public-blog`, `feature/article-crud` visibles |

**Sprint 5 — Definition of Done:**
- [ ] `docker-compose exec app php artisan migrate:fresh --seed` repart proprement
- [ ] Tous les formulaires ont `@csrf` et validation
- [ ] README contient les instructions Docker complètes
- [ ] ≥ 15 commits avec messages clairs

---

## 📦 Checklist Livrables Finaux

| Livrable | Critère | Statut |
|----------|---------|--------|
| GitHub Repo | ≥ 15 commits avec messages explicites | ⬜ |
| GitHub Repo | 3 branches feature visibles dans l'historique | ⬜ |
| Docker | `docker-compose up -d` démarre tous les services | ⬜ |
| Docker | `docker-compose exec app php artisan migrate:fresh --seed` fonctionne | ⬜ |
| Migrations | Toutes les tables créées via migrations (zéro SQL manuel) | ⬜ |
| Seeder | 4 catégories, 1 compte blogger, 6 articles (mix draft/published) | ⬜ |
| README.md | Instructions d'installation avec Docker | ⬜ |
| README.md | Identifiants du compte blogger | ⬜ |

---

## 🏆 Critères de Performance

### Architecture Laravel (40%)
| Critère | Statut |
|---------|--------|
| ✅ Routes nommées — `php artisan route:list` affiche tout | ⬜ |
| ✅ Routes de gestion groupées sous `auth` middleware | ⬜ |
| ✅ Relations Eloquent définies et utilisées dans les controllers | ⬜ |
| ✅ Séparation stricte : logique dans Controllers/Models, affichage dans Blade | ⬜ |
| ✅ Toutes les tables via Migrations (zéro SQL manuel) | ⬜ |

### Fonctionnalités (35%)
| Critère | Statut |
|---------|--------|
| ✅ Connexion / déconnexion fonctionnelle | ⬜ |
| ✅ CRUD complet des articles (create, read, update, delete) | ⬜ |
| ✅ Statut draft / published fonctionnel | ⬜ |
| ✅ Filtre par catégorie sur la page publique | ⬜ |
| ✅ Routes protégées redirigent vers login si non connecté | ⬜ |

### Qualité du Code (25%)
| Critère | Statut |
|---------|--------|
| ✅ `$request->validate()` sur tous les formulaires | ⬜ |
| ✅ `@csrf` présent sur tous les formulaires | ⬜ |
| ✅ `$fillable` défini dans chaque Model | ⬜ |
| ✅ Code lisible, nommage cohérent avec les conventions Laravel | ⬜ |
| ✅ ≥ 15 commits avec messages clairs | ⬜ |

---

## 🎤 Prep — Soutenance (30 min)

### Démo Live (10 min)
| Étape | Prêt |
|-------|------|
| Visiteur voit la liste des articles publiés | ⬜ |
| Visiteur filtre par catégorie | ⬜ |
| Visiteur lit un article complet | ⬜ |
| Connexion blogger → dashboard | ⬜ |
| Créer un draft → passer en published | ⬜ |
| Modifier un article | ⬜ |
| Supprimer un article (avec confirmation) | ⬜ |
| Déconnexion | ⬜ |

### Code Review — Questions à préparer (15 min)
| Question | Préparé |
|----------|---------|
| Tracer une requête `GET /articles/3` de la route jusqu'à la vue Blade | ⬜ |
| Montrer la relation Eloquent Article ↔ Category et l'utiliser dans une vue | ⬜ |
| Montrer comment `auth` middleware protège les routes — que se passe-t-il si un visiteur accède à `/articles/create` ? | ⬜ |

### Live Coding (5 min)
| Exercice | Préparé |
|----------|---------|
| Ajouter un champ `excerpt` (varchar 255) via une nouvelle migration et l'afficher dans la liste publique | ⬜ |

---

*Dernière mise à jour : 20/04/2026*