<?php

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="My Project API",
 *         version="1.0",
 *         description="API documentation for My Project",
 *         @OA\Contact(
 *             email="support@example.com"
 *         )
 *     )
 * )
 */

/**
 * @OA\Tag(
 *     name="Account",
 *     description="Operations in the Account",
 * )
 */

/**
 * @OA\PathItem(
 *     path="/account/accountpage",
 *     @OA\Get(
 *         tags={"Account"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function accountPage() {
    // function body
}

/**
 * @OA\PathItem(
 *     path="/account/sendtestemail",
 *     @OA\Get(
 *         tags={"Account"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function sendTestEmail() {
    // function body
}

/**
 * @OA\Tag(
 *     name="Admin",
 *     description="Operations in the Admin",
 * )
 */

/**
 * @OA\PathItem(
 *     path="/admin/statisticsaction",
 *     @OA\Get(
 *         tags={"Admin"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function statisticsAction() {
    // function body
}

/**
 * @OA\Tag(
 *     name="Api",
 *     description="Operations in the Api",
 * )
 */

/**
 * @OA\PathItem(
 *     path="/api/productsaction",
 *     @OA\Get(
 *         tags={"Api"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function ProductsAction() {
    // function body
}

/**
 * @OA\PathItem(
 *     path="/api/citiesaction",
 *     @OA\Get(
 *         tags={"Api"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function CitiesAction() {
    // function body
}

/**
 * @OA\Tag(
 *     name="Confidentialite",
 *     description="Operations in the Confidentialite",
 * )
 */

/**
 * @OA\PathItem(
 *     path="/confidentialite/politiqueaction",
 *     @OA\Get(
 *         tags={"Confidentialite"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function politiqueAction() {
    // function body
}

/**
 * @OA\Tag(
 *     name="Contact",
 *     description="Operations in the Contact",
 * )
 */

/**
 * @OA\PathItem(
 *     path="/contact/formaction",
 *     @OA\Get(
 *         tags={"Contact"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function formAction() {
    // function body
}

/**
 * @OA\PathItem(
 *     path="/contact/sendaction",
 *     @OA\Get(
 *         tags={"Contact"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function sendAction() {
    // function body
}

/**
 * @OA\PathItem(
 *     path="/contact/contact",
 *     @OA\Get(
 *         tags={"Contact"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function contact() {
    // function body
}


/**
 * @OA\Tag(
 *     name="Home",
 *     description="Operations in the Home",
 * )
 */

/**
 * @OA\PathItem(
 *     path="/home/indexaction",
 *     @OA\Get(
 *         tags={"Home"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function indexAction() {
    // function body
}

/**
 * @OA\PathItem(
 *     path="/product/showaction",
 *     @OA\Get(
 *         tags={"Product"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function showAction() {
    // function body
}

/**
 * @OA\Tag(
 *     name="Search",
 *     description="Operations in the Search",
 * )
 */

/**
 * @OA\PathItem(
 *     path="/search/searchaction",
 *     @OA\Get(
 *         tags={"Search"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function searchAction() {
    // function body
}

/**
 * @OA\Tag(
 *     name="User",
 *     description="Operations in the User",
 * )
 */

/**
 * @OA\PathItem(
 *     path="/user/loginaction",
 *     @OA\Get(
 *         tags={"User"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function loginAction() {
    // function body
}

/**
 * @OA\PathItem(
 *     path="/user/registeraction",
 *     @OA\Get(
 *         tags={"User"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function registerAction() {
    // function body
}

/**
 * @OA\PathItem(
 *     path="/user/accountaction",
 *     @OA\Get(
 *         tags={"User"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function accountAction() {
    // function body
}

/**
 * @OA\PathItem(
 *     path="/user/register",
 *     @OA\Get(
 *         tags={"User"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function register() {
    // function body
}

/**
 * @OA\PathItem(
 *     path="/user/login",
 *     @OA\Get(
 *         tags={"User"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function login() {
    // function body
}

/**
 * @OA\PathItem(
 *     path="/user/createremembermecookie",
 *     @OA\Get(
 *         tags={"User"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function createRememberMeCookie() {
    // function body
}

/**
 * @OA\PathItem(
 *     path="/user/autologin",
 *     @OA\Get(
 *         tags={"User"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function autoLogin() {
    // function body
}

/**
 * @OA\PathItem(
 *     path="/user/logoutaction",
 *     @OA\Get(
 *         tags={"User"},
 *         @OA\Response(response="200", description="Successful operation"),
 *         @OA\Response(response="400", description="Bad request")
 *     )
 * )
 */
function logoutAction() {
    // function body
}
