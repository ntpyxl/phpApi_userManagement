async function registerUser(event) {
	event.preventDefault();

	const formData = Object.fromEntries(new FormData(event.target).entries());
	formData.role = parseInt(formData.role);

	try {
		const response = await fetch("scripts/api.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify({ action: "addUser", data: formData }),
		});

		const result = await response.json();

		if (response.ok) {
			Swal.fire({
				title: "Register success!",
				icon: "success",
				confirmButtonColor: "#14b8a6",
			}).then(() => {
				window.location.href = "login.php";
			});
		} else {
			Swal.fire({
				title: "Register failed!",
				text: result.message || "Something else went wrong!",
				icon: "error",
				confirmButtonColor: "#ef4444",
			});
		}
	} catch (error) {
		Swal.fire({
			title: "Register failed!",
			text: error || "Something else went wrong!",
			icon: "error",
			confirmButtonColor: "#ef4444",
		});
	}
}
