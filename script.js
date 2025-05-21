function validateInput() {
    const input = document.getElementById("cisla").value;
    const errorDiv = document.getElementById("chybovaZprava");
    const regex = /^(\s*\d+\s*)(,\s*\d+\s*)*$/;

    if (!regex.test(input)) {
        errorDiv.textContent = "Zadej pouze čísla oddělená čárkou (např. 5, 12, 8)";
        return false;
    }

    errorDiv.textContent = "";
    return true;
}
