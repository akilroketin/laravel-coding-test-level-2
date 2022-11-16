{ pkgs ? import <nixpkgs> { } }:

pkgs.mkShell {
    name = "laravel-nix-shell";

    buildInputs = [
        pkgs.git
        pkgs.php74
    ];

    shellHook = ''
        echo "Welcome to Nix shell, run using Nix if you want optimal"
    '';
}
