describe("set_item> ", function(){
	describe("select_person_cnt> ", function(){
		beforeEach(function(){
			spyOn(console, "log");
			localStorage.clear();
		});

		//候補者が3人未満の場合のテストコード。
		it("under_3", function(){
			var selected_json = {
				contender3:"333",
				contender5:"555"
			};
			var voter_info = {voter_id : "test"};
			localStorage.setItem('voter_info', JSON.stringify(voter_info));
			localStorage.setItem('Candidate_ID',JSON.stringify(selected_json));
			set_item();
			expect(console.log).toHaveBeenCalledWith("count < 3");
		});

		//候補者が4人の場合のテストコード。
		it("greater_3", function(){
			var selected_json = {
				contender3:"333",
				contender4:"444",
				contender5:"555",
				contender1:"111"
			};
			var voter_info = {voter_id : "test"};
			localStorage.setItem('voter_info', JSON.stringify(voter_info));
			localStorage.setItem('Candidate_ID',JSON.stringify(selected_json));
			set_item();
			expect(console.log).toHaveBeenCalledWith("count > 3");
		});

		it("get-param is nothing", function() {
			var voter_info = null;
			localStorage.setItem('voter_info', voter_info);
			set_item();
			expect(console.log).toHaveBeenCalledWith("get-param is error");
		});
	});
});
