async function loginUser(event) {
	event.preventDefault();

	const formData = Object.fromEntries(new FormData(event.target).entries());

	try {
		const response = await fetch("scripts/api.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify({ action: "loginUser", data: formData }),
		});

		const result = await response.json();

		if (response.ok) {
			Swal.fire({
				title: "Login success!",
				icon: "success",
				confirmButtonColor: "#14b8a6",
			}).then(() => {
				window.location.href = "index.php";
			});
		} else {
			Swal.fire({
				title: "Login failed!",
				text: result.message || "Something else went wrong!",
				icon: "error",
				confirmButtonColor: "#ef4444",
			});
		}
	} catch (error) {
		Swal.fire({
			title: "Login failed!",
			text: error || "Something else went wrong!",
			icon: "error",
			confirmButtonColor: "#ef4444",
		});
	}
}
