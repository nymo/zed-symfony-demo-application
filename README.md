# Symfony for Zed — demo application

A small Symfony 6.4 application that demonstrates the features of the
[Symfony for Zed](https://github.com/nymo/zed-symfony) extension.

Every file in this project is deliberately shaped to exercise one or more of the
extension's feature families — routing, Twig templates, environment variables,
translations, services, Doctrine, forms, and Twig extensions/UX components. Use
it to try the extension, verify editor-visible behavior, and as a manual test
fixture while developing the language server.

This is a showcase, not a production application. The extension performs
syntax-shaped static analysis and never boots Symfony, so the project does not
need to run for the features to work.

## Requirements

- A recent [Zed](https://zed.dev) build.
- The **Symfony for Zed** extension, installed from the gallery or as a dev
  extension.
- The native `symfony-lsp` binary available to Zed (see below).
- Optional: PHP 8.1+ and Composer, only if you want to run the application
  itself.

## How to test

### 1. Install the extension

Install **Symfony** from Zed's extension gallery. If you are developing the
extension from source, build the native server and install the checkout as a dev
extension instead:

```sh
# from the zed-symfony repository
cargo build -p symfony-lsp
```

Then run `zed: install dev extension` in Zed and select the `zed-symfony`
repository root.

### 2. Make the native server available

The extension launcher looks for `symfony-lsp` in the current worktree's
`target/debug` and `target/release` directories, then on `PATH`, before falling
back to a GitHub release download. Because this demo project has no Rust target
directory, expose the locally built binary on `PATH`:

```sh
# from the zed-symfony repository
cargo build -p symfony-lsp
mkdir -p "$HOME/.local/bin"
ln -sf "$PWD/target/debug/symfony-lsp" "$HOME/.local/bin/symfony-lsp"
export PATH="$HOME/.local/bin:$PATH"
```

If you installed the extension from a release, the matching platform binary is
downloaded automatically and this step is not needed.

### 3. Open this project in Zed

```sh
zed --foreground /path/to/zed-symfony-demo-application
```

When launching Zed from the GUI, make sure the same `PATH` is present in the GUI
process environment, or start Zed once from a shell as shown above.

### 4. Try the features

Open the files listed in the [feature tour](#feature-tour) below and use
go-to-definition, hover, completion, references, diagnostics, and code actions.
The extension complements your PHP and Twig servers, so keep those installed for
general language support.

## Feature tour

| Feature family | Where to look |
| --- | --- |
| Route attributes | `src/Controller/AttributeRouteController.php` (`#[Route('/attribute/{id}', name: 'attribute_show')]`) |
| YAML routes | `config/routes.yaml` (`home`, `hello_world`) |
| Route references and parameters | `templates/home/index.html.twig` (`path('hello_world', { name: 'Zed' })`, `path('attribute_show', { id: 42 })`), `src/Controller/HomeController.php` (`$urls->generate('hello_world', ...)`) |
| Twig templates | `src/Controller/HomeController.php` render calls, `templates/home/index.html.twig` (`{% include 'partials/greeting.html.twig' %}`), `templates/partials/greeting.html.twig` |
| Environment variables | `.env`, `.env.dev`, `config/packages/framework.yaml` (`%env(APP_SECRET)%`), `config/packages/doctrine.yaml` (`%env(resolve:DATABASE_URL)%`), `config/examples/services.php` (`env('APP_SECRET')`) |
| Translations | `translations/messages.en.yaml`, `translations/validators.en.xlf`, `templates/home/index.html.twig` (`'home.title'|trans`), `templates/home/hello.html.twig` (`'hello.title'|trans`) |
| Services (YAML) | `config/services.yaml` (`hello.world.generator`, aliases, tags, `bind`) |
| Services (XML) | `config/examples/services.xml` |
| Services (PHP configurator) | `config/examples/services.php` |
| Service references and autowiring | `src/HelloWorld/Generator.php`, `ServiceConsumer.php`, `AutowireConsumer.php` (`#[Autowire(service: 'hello.world.generator')]`) |
| Doctrine (attributes) | `src/Member/Entity/Member.php`, `src/Member/Entity/Team.php` (relations, join columns) |
| Doctrine (YAML/XML mapping) | `config/doctrine/yaml/Label.orm.yml`, `config/doctrine/xml/Region.orm.xml` |
| Doctrine QueryBuilder fields | `src/Member/Repository/MemberRepository.php` |
| Forms | `src/Member/Form/MemberType.php` (`data_class`, `EntityType`), `templates/member/showcase.html.twig` (`form_widget(form.email)`) |
| Twig extensions | `src/Twig/MemberExtension.php` (function, filter, test), `src/Twig/TokenParser/NoticeTokenParser.php` (custom `{% notice %}` tag) |
| Twig UX components | `src/Twig/Components/MemberBadge.php`, `templates/member/showcase.html.twig` (`<twig:member_badge ... />`, `component('member_badge', ...)`) |

### Quick actions and diagnostics

A few files intentionally contain gaps so the extension can offer quick fixes
and warnings:

- `src/Controller/AttributeRouteController.php::preview()` has no route — try
  the **add a route attribute** quick fix.
- `AttributeRouteController` is registered without
  `controller.service_arguments` in `config/services.yaml` — try the **add
  service tag** quick fix.
- `src/HelloWorld/InjectionDemo.php` uses `$this->generator` without a
  constructor — try the **inject a matching service property** quick fix.
- Reference a non-existent template, route, translation key, environment
  variable, or Doctrine target to see the corresponding missing-* diagnostic.

## Running the application (optional)

The extension does not require the app to run, but you can start it to see the
demo pages:

```sh
composer install
php -S localhost:8000 -t public
```

Then open `http://localhost:8000/`. The `home`, `hello_world`, and
`attribute_show` routes are wired to the controllers above.

## Learn more

- [Symfony for Zed README](https://github.com/nymo/zed-symfony#readme) — features,
  installation, and configuration.
- [Feature matrix](https://github.com/nymo/zed-symfony/blob/main/docs/feature-matrix.md)
  — supported forms and current limits.
- [Development guide](https://github.com/nymo/zed-symfony/blob/main/docs/development.md)
  — building the server and installing the dev extension.
