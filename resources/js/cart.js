import axios from 'axios';

let savedItems =  JSON.parse(localStorage.getItem("cart")) || [];
export default {
    state: {
        items: savedItems,
        synced: savedItems.length === 0,
    },
    getters: {
        items(state) {
            if (!state.synced) {
                axios.get('/api/cart/products', {
                    params: {
                        ids: state.items.map(item => item.product.id)
                    }
                }).then(response => {
                    response.data.products.forEach(product => {
                        let cartItem = state.items.find(item => item.product.id === product.id);
                        if (cartItem) {
                            cartItem.product = product;
                        }
                    });
                    state.synced = true;
                });
            }
            return state.items;
        },
        total(state, getters) {
            return getters.items.reduce((previousValue, item) => {
                return previousValue + (item.quantity * item.product.final_price);
            }, 0);
        },
    },
    mutations: {
        ADD_TO_CART(state, {product, quantity}) {
            let alreadyInCart = state.items.find(item => item.product.id === product.id);
            if (alreadyInCart) {
                alreadyInCart.quantity++;
            } else {
                state.items.push({
                    product: product,
                    quantity: quantity
                });
            }
            saveToLocalStorage(state.items);
        },
        // todo save email in local storage
        // SAVE_EMAIL(state,) {
        //     saveToLocalStorage(state.items);
        // },
        REMOVE_FROM_CART(state, {product, quantity}) {
            let cartItem = state.items.find(item => item.product.id === product.id);
            if (cartItem.quantity === 1) {
                // should delete
                let index = state.items.indexOf(cartItem);
                state.items.splice(index, 1);
            } else {
                cartItem.quantity--;
            }
            saveToLocalStorage(state.items);
        },
        CLEAR_CART(state) {
            state.items = []
            localStorage.clear()

        }
    },
    actions: {
        addToCart(context, payload) {
            context.commit("ADD_TO_CART", payload);
        },
        removeFromCart(context, payload) {
            context.commit("REMOVE_FROM_CART", payload);
        },
        clearCart(context) {
            context.commit("CLEAR_CART");
        }
    },

}

function saveToLocalStorage(cart) {
    let string = JSON.stringify(cart);
    localStorage.setItem("cart", string);
}
