import globals from "globals";
import eslintConfigPrettier from "eslint-config-prettier";

export default [
  eslintConfigPrettier,
  {languageOptions: { globals: globals.browser }},
];
